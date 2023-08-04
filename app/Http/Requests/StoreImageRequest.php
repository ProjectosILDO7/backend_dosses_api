<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'imagens'=>'required',
            'titulo'=>'required',
            'conteudo'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'imagens.required'=>'Precisas selecionar uma imagem',
            'titulo.required'=>'Precisas digitar um titulo desta imagem',
            'conteudo.required'=>'Precisas digitar um conteudo desta imagem'
        ];
    }
}
