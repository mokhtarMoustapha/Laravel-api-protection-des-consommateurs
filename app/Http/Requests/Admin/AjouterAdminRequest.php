<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AjouterAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'email' => 'required|email|unique:admins',

        ];
    }
    public function messages(){
        return[
           'password.required' => 'Le mot de passe est obligatoire.',
           'email.required' => 'email  est obligatoire.',
           'email.unique'=>'email existe dejas',
           'email.email' => 'L\'email doit être un format valide.',
        ];
    }
}
