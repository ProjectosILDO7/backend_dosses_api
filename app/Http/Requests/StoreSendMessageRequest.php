<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSendMessageRequest extends FormRequest
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
            'nome' => 'required',
            'telemovel' => 'required|numeric',
            'email' => 'required|email',
            'mensagem' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Preenchimento obrigatório',
            'telemovel.required' => 'Preenchimento obrigatório',
            'telemovel.numeric' => 'Este campo tem de ser do tipo numérico',
            'email.required' => 'Preenchimento obrigatório',
            'email.email' => 'E-amil inaválido',
            'mensagem.required' => 'Preenchimento obrigatório',
        ];
    }
}
