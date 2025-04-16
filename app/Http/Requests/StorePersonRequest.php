<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{

    /**
     * Obtenha as regras de validação que devem ser aplicadas à requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'cpf' => 'required|unique:people',
            'rg' => 'nullable|string|max:20',
            'birth_date' => 'required|date|before:today',
            'email' => 'required|email|unique:people,email',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'marital_status' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',

            'address' => 'required|array',
            'address.street' => 'required|string|max:255',
            'address.number' => 'required|string|max:10',
            'address.complement' => 'nullable|string|max:100',
            'address.neighborhood' => 'required|string|max:100',
            'address.city' => 'required|string|max:100',
            'address.state' => 'required|string|max:100',
            'address.zip_code' => 'required|string|regex:/^\d{5}-\d{3}$/',
            'address.country' => 'nullable|string|max:100',
        ];
    }

}
