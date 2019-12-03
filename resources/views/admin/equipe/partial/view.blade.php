@component('components.box')
    @slot('type', 'primary')
    @slot('icon', 'eye')
    @slot('title', 'Visualizando '.$txt_plural)
    
    @slot('actions')
        @if(Gate::allows('editar-'.str_slug($txt_plural)))
            <a href="{{ route(str_slug($txt_plural).'.edit', ['id' => $model->id]) }}" class="btn btn-flat btn-primary btn-sm btn-toggle">
                Editar {{ $txt_singular }}
            </a>
        @endif
    @endslot

    <strong>ID:</strong> {{ $model->id}} <br>
    <strong>Nome:</strong> {{ $model->nome }} <br>
    <strong>Agentes na equipe:</strong> <br>
    @foreach($model->agentes as $agente)
        <span class="badge">{{ $agente->nome }}</span> <br>
    @endforeach

@endcomponent