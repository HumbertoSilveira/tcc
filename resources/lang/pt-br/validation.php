<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é uma URL válida.',
    'after'                => 'O :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O :attribute deve conter somente letras.',
    'alpha_dash'           => 'O :attribute deve conter letras, números, traços e sublinhados.',
    'alpha_num'            => 'O :attribute deve conter somente letras e números.',
    'array'                => 'O :attribute deve ser um array.',
    'before'               => 'O :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve estar entre :min e :max caracteres.',
        'array'   => 'o :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não confere.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não confere com o formato :format.',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute não tem dimensões válidas.',
    'distinct'             => 'O :attribute campo contém um valor duplicado.',
    'email'                => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute precisa ser um arquivo.',
    'filled'               => 'O :attribute é um campo obrigatório.',
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute é inválido.',
    'in_array'             => 'O :attribute campo não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'json'                 => 'O :attribute deve ser um JSON válido.',
    'max'                  => [
        'numeric' => 'O campo :attribute não deve ser maior que :max.',
        'file'    => 'O campo :attribute não deve ter mais que :max kilobytes.',
        'string'  => 'O campo :attribute não deve ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file'    => 'O campo :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'array'   => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O :attribute é necessário a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same'                 => 'O :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O :attribute deve ser :size.',
        'file'    => 'O :attribute deve ter :size kilobytes.',
        'string'  => 'O :attribute deve ter :size caracteres.',
        'array'   => 'O :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string',
    'timezone'             => 'O campo :attribute deve ser uma timezone válida.',
    'unique'               => 'O :attribute já está cadastrado.',
    'uploaded'             => 'O campo :attribute falhou no upload.',
    'url'                  => 'O formato de url do campo :attribute é inválido.',

    'cpf'                  => 'O CPF informado é inválido.',
    'cnpj'                 => 'O CNPJ informado é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'nome' => 'nome',
        'email' => 'e-mail',
        'data_nascimento' => 'data de nascimento',
        'pais_id' => 'país',
        'estado_id' => 'estado',
        'uf' => 'unidade federativa',
        'tipo_id' => 'tipo',
        'municipio_id' => 'município',
        'usuario' => 'usuário',
        'senha_confirmation' => 'confirme a senha',
        'produto_id' => 'produto',
        'segmento_id' => 'segmento',
        'categoria_id' => 'categoria',
        'marca_id' => 'marca',
        'cor_id' => 'cor',
        'tamanho_id' => 'tamanho',
        'data_movimentacao' => 'data de movimentação',
        'inicia_em' => 'inicia em',
        'termina_em' => 'termina em',
        'login' => 'login',
        'password' => 'senha'
    ],

];
