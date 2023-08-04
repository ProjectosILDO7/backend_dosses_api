<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateclienteRequest extends FormRequest
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
            'telemovel' => "required|string|numeric|min:9|unique:users,telemovel,{$id},id",
            'endereco'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O campo do nome tem de ser preenchido',
            'email.required'=>'O campo do e-mail tem de ser preenchido',
            'telemovel.required'=>'O nº do documento tem de ser preenchido',
        ];
    }
}
