<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
    public function rules()
    {
        $id=$this->id ?? '';
        return [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users",
            'telemovel' => "required|string|numeric|min:9|unique:users,telemovel,{$id},id",
            'password' =>'required|string|min:6|max:15|confirmed',
            'password_confirmation' =>'required|string|min:6|max:15',
        ];

    }

    public function messages()
    {
       return [
        'name.required' => 'O campo nome é de preenchimento obrigatório!',
        'password.required' => 'O campo da senha é de preenchimento obrigatório!',
        'password.min' => 'O campo da senha deve ter no mínimo 6 caracter!',
        'password.max' => 'O campo da senha deve ter no máximo 15 caracter!',
        'email.required' => 'O campo de E-mail é de preenchimento obrigatório!!',
        'email.email' => 'O campo de E-mail deve ser do tipo de e-mail ( @ )!',
        'password.confirmed' => 'O campo da senha deve ser idêntico!',
        'telemovel.required' => 'O campo telemovel é de preenchimento obrigatório!',
        'telemovel.numeric' => 'O campo telemovel deve ser numérico!',
        'telemovel.min' => 'O campo do telemóvel deve ter no minimo 9 caracter!',
        'telemovel.unique' => 'O nº de telemóvel informado já existe...!',
        //'telemovel.max' => 'O campo do telemóvel deve ter no máximo 9 caracter!',
        'password_confirmation.required'=>'O campo de confirmação da senha é de preenchimento obrigatório!'
       ];
    }
}
