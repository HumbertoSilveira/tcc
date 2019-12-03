<div class="row">
    <div class="col-md-9">
        @component('components.box')
            @slot('type', $box_type)
            @slot('title', 'Dados do '.$txt_singular)
            @slot('icon', 'info-circle')

            {{ Form::bsText('Nome', 'nome', null, ['maxlength' => 255]) }}
            {{ Form::bsTextarea('Descrição', 'descricao', null, ['class' => 'ckeditor']) }}
{{--            {{ Form::bsTextarea('Descrição', 'descricao', null, ['class' => 'ckeditor2']) }}--}}

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
    
        @component('components.box')
            @slot('type', $box_type)
            @slot('icon', 'users')
            @slot('title', 'Equipe')
            
            {{ Form::bsSelect(null, 'equipe_id', $equipes, null, ['class' => 'select2', 'data-close-on-select' => 'true', 'data-placeholder' => 'Selecione uma equipe']) }}
{{--            {{ Form::bsSelect(null, 'equipe_id', $equipes, null, ['class' => 'select2A', 'data-close-on-select' => 'true', 'data-placeholder' => 'Selecione uma equipe']) }}--}}
            
        @endcomponent
    </div>
</div>

@push('scripts')
<script>
    $(function () {

    });
</script>
@endpush
