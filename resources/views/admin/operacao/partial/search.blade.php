{!! Form::open(['route' => str_slug($txt_plural).'.index', 'method' => 'get']) !!}
    @component('components.box')
        @slot('type', 'default')
        @slot('icon', 'search')
        @slot('title', 'Pesquisar')
        @slot('body_class', 'form-advanced-search')

        @slot('actions')
            <button type="submit" class="btn btn-primary btn-flat btn-sm btn-toggle">Pesquisar</button>
            {{ link_to_route(str_slug($txt_plural).'.index', 'Limpar', [], ['class' => 'btn btn-default btn-flat btn-sm btn-toggle']) }}
        @endslot

        <div class="row">
            <div class="col-xs-3">
                {{ Form::bsText('Nome', 'nomeF', request('nomeF')) }}
            </div>
        </div>

    @endcomponent
{!! Form::close() !!}
