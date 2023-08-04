<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            'categoria_id' => 'bail|required',
            'nome_produto' => 'bail|required|unique:produtos,nome_produto',
            'image_produto' => 'bail|required',
            'descricao' => 'bail|nullable',
            'preco' => 'bail|required',
            'receita' => 'bail|nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'categoria_id.required' => 'Selecione selecione uma categoria',
            'nome_produto.required' => 'Informe o nome do produto',
            'image_produto.required' => 'Selecione uma image para este produto',
            'descricao.required' => 'Informe uma descrição do produto',
            'preco.required' => 'Informe um preço',
        ];
    }
}
