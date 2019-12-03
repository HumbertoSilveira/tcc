@component('components.box')
    @slot('type', 'primary')
    @slot('icon', 'eye')
    @slot('title', 'Visualizando '.$txt_singular)
    
    @slot('actions')
        @if(Gate::allows('definir-permissoes'))
            <a href="{{ route(str_slug($txt_plural).'.permissoes', ['id' => $model->id]) }}" class="btn btn-flat bg-purple btn-sm btn-toggle">
                Definir Permissões
            </a>
        @endif

        @if(Gate::allows('editar-perfis-de-usuario'))
            <a href="{{ route(str_slug($txt_plural).'.edit', ['id' => $model->id]) }}" class="btn btn-flat btn-primary btn-sm btn-toggle">
                Editar perfil
            </a>
        @endif
    @endslot

    <strong>ID:</strong> {{ $model->id}} <br>
    <strong>Nome:</strong> {{ $model->nome }} <br>
    <strong>Descrição:</strong> {{ $model->descricao }} <br>
    <strong>Criado em:</strong> {{ $model->created_at->format('d/m/Y - H:i:s') }} <br>
    <strong>Modificado em:</strong> {{ $model->updated_at->format('d/m/Y - H:i:s') }} <br>

    <br><strong>Permissões do perfil:</strong><br>

    @foreach($model->permissoes as $permissao)
        <a href="{{ route('permissoes.index', ['id' => $permissao->id, 'nomeF' => $permissao->nome]) }}" title="Clique para visualizar a permissão {{ $permissao->nome }}">
            <span class="badge"><i class="fa fa-check fa-fw"></i> {{ $permissao->nome }}</span>
        </a>
    @endforeach

    <br><br><strong>Usuários do perfil:</strong><br>

    @foreach($model->usuarios as $usuario)
        <a href="{{ route('usuarios.index', ['id' => $usuario->id]) }}" title="Clique para visualizar o usuário {{ $usuario->nome }}">
            <span class="badge">{{ $usuario->nome }}</span>
        </a>
    @endforeach

@endcomponent