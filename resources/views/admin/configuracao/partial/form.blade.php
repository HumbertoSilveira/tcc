<div class="row">
    <div class="col-md-9">
        @component('components.box')
            @slot('type', $box_type)
            @slot('title', 'Dados da '.$txt_singular)
            @slot('icon', 'info-circle')

            {{ Form::bsText('Nome', 'nome', null, ['maxlength' => 255]) }}
            {{ Form::bsText('Descricao', 'descricao', null, ['maxlength' => 255]) }}
            {{ Form::bsTextarea('Valor', 'valor', null, ['class' => 'ckeditor']) }}

        @endcomponent
    </div>
    <div class="col-md-3">
        @component('components.box')
            @slot('type', $box_type)
            @slot('icon', 'link')
            @slot('title', 'Ações')

            @slot('body_class', 'padding-30')

            <div class="text-center">
                @if($action == 'create')
                    <button type="submit" class="btn btn-flat btn-block btn-primary btn-toggle">{{ 'Salvar '.$txt_singular }}</button>
                    {!! link_to_route(str_slug($txt_plural).'.index', 'Voltar', request()->all(), ['class' => 'btn btn-default btn-flat btn-block btn-toggle']) !!}
                @else
                    <button type="submit" class="btn btn-flat btn-block btn-warning btn-toggle">{{ 'Atualizar '.$txt_singular }}</button>
                    {!! link_to_route(str_slug($txt_plural).'.index', 'Voltar', ['id' => $result->id] + request()->all(), ['class' => 'btn btn-default btn-block btn-toggle']) !!}
                @endif
            </div>
        @endcomponent

        @if(auth()->user()->hasAnyRole('root'))
            @component('components.box')
                @slot('type', $box_type)
                @slot('icon', 'exchange')
                @slot('title', 'Somente perfil root')

                @slot('body_class', 'padding-30')

                {{ Form::bsSwitch(null, 'root', 'S', (isset($result) && $result->root == 'S' ? true : false), ['data-size' => 'medium', 'data-on-text' => 'Sim', 'data-off-text' => 'Não', 'id' => 'ativo']) }}

            @endcomponent
        @endif
    </div>
</div>

@push('scripts')
<script>
    $(function () {

    });
</script>
@endpush
