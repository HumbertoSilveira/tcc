@component('components.box')
    @slot('type', 'default')
    @slot('icon', 'search')
    @slot('title', 'Busca avançada')
    @slot('body_class', 'form-advanced-search')

    {!! Form::open(['route' => 'administracao.perfis.index', 'method' => 'get', 'class' => 'form-inline']) !!}
        {{ Form::bsText('Nome', 'nomeF', request('nomeF')) }}
        {{ Form::bsSelect('Cor', 'skinF', $skinF, null) }}

        <div class="form-group no-margin">
            {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary']) }}
            {{ link_to_route('administracao.perfis.index', 'Limpar', [], ['class' => 'btn btn-default']) }}
        </div>
    {!! Form::close() !!}
@endcomponent
