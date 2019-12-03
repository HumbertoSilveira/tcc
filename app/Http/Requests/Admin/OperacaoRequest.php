<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OperacaoRequest extends FormRequest
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
            'nome' => 'required|max:191|unique:operacoes',
            'descricao' => 'required',
            'equipe_id' => 'required',
        ];

        if ($this->get('_method') == 'PUT') {
            $rules['nome'] = 'required|max:50|unique:operacoes,nome,' . $this->route('id');
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
            'nome.unique' => 'Esta operação já existe.',
            'equipe_id.required' => 'Selecione uma equipe.',
        ];

        return $messages;
    }
}
