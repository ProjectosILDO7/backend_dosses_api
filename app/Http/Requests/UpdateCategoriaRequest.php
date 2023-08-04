<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
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
        return [
            'nome_categoria'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nome_categoria.required'=>'Informe o nome da categoria',
            'nome_categoria.unique'=>'A categoria que pretende cadastrar já existe',
        ];
    }
}
