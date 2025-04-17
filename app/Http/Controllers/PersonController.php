<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Address;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Traits\HasCache;

class PersonController extends Controller
{
    use HasCache;

    public function index()
    {
        $cacheKey = "todas_as_pessoas";

        $people = $this->getFromCache($cacheKey, function () {
            return Person::with('address')->get();
        });

        return response()->json($people);
    }

    public function show($id)
    {
        $cacheKey = "pessoa_com_endereco_{$id}";

        $person = $this->getFromCache($cacheKey, function () use ($id) {
            return Person::with('address')->findOrFail($id);
        });

        return response()->json($person);
    }

    public function store(StorePersonRequest $request)
    {
        $person = Person::create($request->validated());

        $addressData = $request->input('address');
        if ($addressData) {
            $addressData['person_id'] = $person->id;
            Address::create($addressData);
        }

        return response()->json($person->load('address'), 201);
    }

    public function update(UpdatePersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);

        $person->update($request->validated());

        $addressData = $request->input('address');
        if ($addressData) {
            $address = $person->address;
            if ($address) {
                $address->update($addressData);
            } else {
                $addressData['person_id'] = $person->id;
                Address::create($addressData);
            }
        }

        $this->forgetCache("pessoa_com_endereco_{$id}");

        return response()->json($person->load('address'));
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        $this->forgetCache("pessoa_com_endereco_{$id}");
        $this->forgetCache("todas_as_pessoas");

        return response()->json(['message' => 'Person deleted successfully']);
    }
}
