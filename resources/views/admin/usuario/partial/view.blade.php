@component('components.box')
    @slot('type', 'primary')
    @slot('icon', 'eye')
    @slot('title', 'Visualizando usuário')
    
    @slot('actions')
        <a href="{{ route('usuarios.edit', ['id' => $model->id]) }}" class="btn btn-flat btn-primary btn-sm btn-toggle">
            Editar usuário
        </a>
    @endslot

    <div class="row">
        <div class="col-xs-12 col-md-2 text-center">
            @if(!is_null($model->imagem))
                <img src="{{ asset('storage/uploads/usuarios/'.$model->imagem) }}" alt="Imagem do usuário" class="img-circle">
            @else
                <img src="{{ asset('assets/imagens/sem-foto.jpg') }}" alt="Usuário sem foto" class="img-circle">
            @endif
        </div>
        <div class="col-xs-12 col-md-10">
            <div class="dados-container">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="well well-sm">
                            <strong>ID:</strong> {{ str_pad($model->id, 4, '0', STR_PAD_LEFT) }} <br>
                            <strong>Nome:</strong> {{ $model->nome }} <br>
                            <strong>Login:</strong> {{ $model->login }} <br>
                            <strong>CPF:</strong> {{ $model->cpf_formatado }} <br>
                            <strong>Telefone:</strong> {{ $model->telefone_formatado }} <br>
                            <strong>Celular:</strong> {{ $model->celular_formatado }} <br>
                            <strong>E-mail:</strong> {{ $model->email }} <br>
                            <strong>Cor do Sistema:</strong> {{ config('app.models.usuarios.opcoes_skin')[$model->skin] }} <br>
                            <strong>Ativo:</strong> {{ $model->ativo_nome }} <br>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="well well-sm">
                            <strong>Criado em:</strong> {{ $model->created_at->format('d/m/Y - H:i:s') }} <br>
                            <strong>Atualizado em:</strong> {{ $model->updated_at->format('d/m/Y - H:i:s') }} <br>
                            <strong>Último acesso:</strong> {{ optional($model->ultimo_acesso)->format('d/m/Y - H:i:s') }} <br>
                            <strong>Última atividade:</strong> {{ optional($model->ultima_atividade)->format('d/m/Y - H:i:s') }} <br>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="well well-sm">


                            <strong>Perfil(s) de usuário:</strong> <br>
                            @foreach($model->perfis as $perfil)
                                <a href="{{ route('perfis.permissoes', ['id' => $perfil->id]) }}" title="Clique para editar as permissões do perfil {{ strtolower($perfil->nome) }}">
                                    <span class="badge">{{ $perfil->nome }}</span>
                                </a>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endcomponent