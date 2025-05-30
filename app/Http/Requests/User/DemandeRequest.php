<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            "commune"=>'required|string',
            "horaires"=>'required|string',
        ];
    }
    public function messages(){
        return[
        'commune.required' => "le commune est obligatoire",
        'commune.string' => "le commune est un chaine de caractere",
        'horaires.required'=> "horaires est obligatoire",
        'horaires.string'=> "horaires est un chaine de caractere"
        ];

    }
}
