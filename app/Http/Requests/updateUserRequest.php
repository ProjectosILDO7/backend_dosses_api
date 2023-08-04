<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
        $id = $this->id ?? '';
        return [
            'name' => 'required|string|max:255',
            'email'=>"required|string|email|unique:users,email,{$id},id",
            'password' =>'nullable|string|min:6|max:15',
            'telemovel' => "required|string|numeric|min:9|unique:users,telemovel,{$id},id",
        ];

        // if($this->method('PUT')){
        //     $rules['password'] = ['nullable', 'min:6', 'max:15'];
        //     $rules['email'] = ['required', 'string', 'email', 'max:255'];
        // }

        //return $rules;
    }
}
