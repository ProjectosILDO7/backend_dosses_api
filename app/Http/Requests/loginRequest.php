<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'bail|required|email',
            'password'=>'bail|required|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required'=>'O Campo de e-mail deve ser preenchido',
            'email.email'=>'E-mail inválido...!',
            'password.required'=>'Imforme a sua palavra passe',
            'password.min'=>'A sua palavra passa deve ter no mínimo 8 carácter',
            //'password.max'=>'A sua palavra passa deve ter no máximo 16 carácter',
        ];
    }
}
