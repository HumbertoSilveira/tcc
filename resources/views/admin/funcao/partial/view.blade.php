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

@endcomponent