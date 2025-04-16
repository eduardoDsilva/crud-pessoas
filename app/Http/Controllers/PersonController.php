<?php


namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Jobs\SendPersonCreatedEmail;
use App\Models\Address;
use App\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{

    public function index()
    {
        return response()->json(Person::all());
    }

    public function store(StorePersonRequest $request)
    {
        $person = Person::create($request->validated());

        $addressData = $request->input('address');
        $addressData['person_id'] = $person->id;

        $address = Address::create($addressData);

        dispatch(new SendPersonCreatedEmail($person));

        return response()->json([
            'person' => $person,
            'address' => $address
        ], 201);
    }

    public function show($id)
    {
        $person = Person::with('address')->findOrFail($id);
        return response()->json($person);
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

        return response()->json($person->load('address'));
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json(['message' => 'Person deleted successfully']);
    }
}
