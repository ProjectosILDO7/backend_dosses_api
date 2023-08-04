<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuncionarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->id ?? '';
        return [
            'name'=>'required|string',
            'email'=>"required|string|email|unique:users,email,{$id},id",
            'telemovel'=>'required|string',
            'endereco'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O campo do nome tem de ser preenchido',
            'email.required'=>'O campo do e-mail tem de ser preenchido',
            'email.unique'=>'O campo do e-mail tem de ser único',
            'telemovel.required'=>'O nº do telemóvel tem de ser preenchido',
            'telemovel.min'=>'O nº do telemóvel tem de ter no minimo 9 caracter',
            'telemovel.max'=>'O nº do telemóvel tem de ter no máximo 9 caracter',
            'endereco.required'=>'O campo do endereço tem de ser preenchido',
        ];
    }
}
