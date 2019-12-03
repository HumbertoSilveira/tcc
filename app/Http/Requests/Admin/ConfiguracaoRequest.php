<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracaoRequest extends FormRequest
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
            'nome' => 'required|max:255|unique:configuracoes',
            'valor' => 'required',
        ];

        if ($this->get('_method') == 'PUT') {
            $rules['nome'] = 'required|max:255|unique:configuracoes,nome,' . $this->route('id');
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
        ];

        return $messages;
    }
}
