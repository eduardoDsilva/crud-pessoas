<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $personId = $this->route('person');

        return [
            'full_name' => 'sometimes|required|string|max:255',
            'cpf' => 'nullable|string|unique:people,cpf,' . $personId,
            'rg' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'email' => 'nullable|email|unique:people,email,' . $personId,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'marital_status' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',

            'address.street' => 'sometimes|required|string|max:255',
            'address.number' => 'sometimes|required|string|max:10',
            'address.complement' => 'nullable|string|max:100',
            'address.neighborhood' => 'sometimes|required|string|max:100',
            'address.city' => 'sometimes|required|string|max:100',
            'address.state' => 'sometimes|required|string|max:100',
            'address.zip_code' => 'sometimes|required|string|regex:/^\d{5}-\d{3}$/',
            'address.country' => 'nullable|string|max:100',
        ];
    }
}
