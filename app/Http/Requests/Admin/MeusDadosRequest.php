<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MeusDadosRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nome' => 'required|max:255',
            'login' => 'required|alpha_dash|max:25|unique:users',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6|required_with:password',
            'email' => 'nullable|email',
            'imagem' => 'image'
        ];

        if ($this->get('_method') == 'PUT') {
            $rules['login'] = 'required|alpha_dash|max:25|unique:users,login,' . auth()->user()->id;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'usuario.unique' => 'O usuário já está cadastrado.',
            'perfis.required' => 'O campo perfil é obrigatório.',
            'password_confirmation.required' => 'O campo confirmação de senha é obrigatório.',
        ];

        return $messages;
    }
}
