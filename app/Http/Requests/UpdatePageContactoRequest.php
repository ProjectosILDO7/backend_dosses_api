<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageContactoRequest extends FormRequest
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
            'facebook'=>'required',
            'link_facebook'=>'required',
            'youtube'=>'required',
            'link_youtube'=>'required',
            'whatsapp'=>'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'facebook.required'=>'Este campo é de preenchimento obrigatório',
            'link_facebook.required'=>'Este campo é de preenchimento obrigatório',
            'youtube.required'=>'Este campo é de preenchimento obrigatório',
            'link_youtube.required'=>'Este campo é de preenchimento obrigatório',
            'whatsapp.required'=>'Este campo é de preenchimento obrigatório',
            'whatsapp.numeric'=>'Este campo tem de ser do tipo numerico'
        ];
    }
}
