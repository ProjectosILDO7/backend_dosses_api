<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpadateImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
