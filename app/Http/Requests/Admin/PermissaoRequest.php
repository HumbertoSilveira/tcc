<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissaoRequest extends FormRequest
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
            'nome' => 'required|max:255|unique:permissoes',
            'modulo_id' => 'required',
        ];

        if ($this->get('_method') == 'PUT') {
            $rules['nome'] = 'required|max:255|unique:permissoes,nome,' . $this->route('id');
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
            'nome.unique' => 'A configuração já está cadastrada.',
            'modulo_id.required' => 'O campo módulo é obrigatório.',
        ];

        return $messages;
    }
}
