<div class="row">
    <div class="col-md-9">
        @component('components.box')
            @slot('type', $box_type)
            @slot('title', 'Dados do '.$txt_singular)
            @slot('icon', 'info-circle')

            {{ Form::bsText('Nome', 'nome', null, ['maxlength' => 255]) }}
            {{ Form::bsText('Descricao', 'descricao', null, ['maxlength' => 255]) }}

        @endcomponent
    </div>
    <div class="col-md-3">
        @component('components.box')
            @slot('type', $box_type)
            @slot('icon', 'link')
            @slot('title', 'Ações')

            @slot('body_class', 'padding-30')

            <div class="text-center">
                {!! Form::button('Marcar/Desmarcar todas', ['class' => 'btn bg-maroon btn-block btn-all-permissions']) !!}
                @if($action == 'create')
                    <button type="submit" class="btn btn-flat btn-block btn-primary btn-toggle">{{ 'Salvar '.$txt_singular }}</button>
                    {!! link_to_route(str_slug($txt_plural).'.index', 'Voltar', request()->all(), ['class' => 'btn btn-default btn-flat btn-block btn-toggle']) !!}
                @else
                    <button type="submit" class="btn btn-flat btn-block btn-warning btn-toggle">{{ 'Atualizar '.$txt_singular }}</button>
                    {!! link_to_route(str_slug($txt_plural).'.index', 'Voltar', ['id' => $result->id] + request()->all(), ['class' => 'btn btn-default btn-block btn-toggle']) !!}
                @endif
            </div>
        @endcomponent
    </div>
</div>

<h3 class="page-header">Permissões do perfil</h3>
<div class="row">
    <div class="col-xs-12">
        @include('admin.perfil.partial.form_permissoes')
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('.view-all').change(function(){
            $('.view-item').prop('checked', $(this).prop("checked"));
        });
        $('.edit-all').change(function(){
            $('.edit-item').prop('checked', $(this).prop("checked"));
        });
        $('.del-all').change(function(){
            $('.del-item').prop('checked', $(this).prop("checked"));
        });
    });
</script>
@endpush
