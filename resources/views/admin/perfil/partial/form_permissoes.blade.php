@foreach($modulos as $modulo)
    @component('components.box')
        @slot('type', 'warning')
        @slot('icon', 'key')
        @slot('title', $modulo->nome)

        @slot('actions')
            {!! Form::button('Marcar/Desmarcar permissoes', ['class' => 'btn bg-purple btn-flat btn-sm btn-toggle-permissoes-modulo']) !!}
        @endslot

        <div class="funkyradio">
            <div class="row">
                @foreach($modulo->permissoes as $permissao)
                    <div class="col-md-4">
                        <div class="funkyradio-info">
                            {!! Form::checkbox('permissoes[]', $permissao->id, isset($result) && $result->permissoes->contains($permissao->id), ['id' => 'permissao_'.$permissao->id, 'class' => 'check_permissoes']) !!}
                            <label for="{{ 'permissao_'.$permissao->id }}">{{ $permissao->nome }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endcomponent
@endforeach

@push('js')
<script>
    $(document).ready(function () {
        $('.btn-all-permissions').on('click', function(){
            $('.check_permissoes').prop('checked', !$('.check_permissoes').prop('checked'));
        });

        $('.btn-toggle-permissoes-modulo').on('click', function(){
            var checked = $(this).closest('.box').find('.check_permissoes').prop('checked');
            $(this).closest('.box').find('.check_permissoes').prop('checked', !checked);;
        });
    });
</script>
@endpush