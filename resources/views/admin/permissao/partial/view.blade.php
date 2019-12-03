@component('components.box')
    @slot('type', 'primary')
    @slot('icon', 'eye')
    @slot('title', 'Visualizando '.$txt_singular)
    
    @slot('actions')
        @if(Gate::allows('editar-'.str_slug($txt_plural)))
            <a href="{{ route(str_slug($txt_plural).'.edit', ['id' => $model->id]) }}" class="btn btn-flat btn-primary btn-sm btn-toggle">
                Editar {{ $txt_singular }}
            </a>
        @endif
    @endslot

    <strong>ID:</strong> {{ $model->id}} <br>
    <strong>Nome:</strong> {{ $model->nome }} <br>
    <strong>Usar como:</strong> {{ $model->slug }} <br>
    <strong>Módulo:</strong> {{ $model->modulo->nome }} <br>

    <br><br><strong>Perfil(s) com esta permissão:</strong> <br>
    @foreach($model->perfis as $perfil)
        <a href="{{ route('perfis.index', ['id' => $perfil->id]) }}" title="Clique para visualizar o perfil {{ $perfil->nome }}">
            <span class="badge">{{ $perfil->nome }}</span>
        </a>
    @endforeach

@endcomponent