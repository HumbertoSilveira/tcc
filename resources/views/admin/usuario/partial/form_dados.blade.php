@if($errors->all())
    {{ dd($errors->all()) }}
@endif
<div class="row">
    <div class="col-md-9">
        @component('components.box')
            @slot('type', $box_type)
            @slot('title', 'Meus dados')
            @slot('icon', 'info-circle')

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsText('Nome', 'nome', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Login', 'login', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsSelect('Cor do sistema', 'skin', $opcoes_skin, null, ['class' => 'select2']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsText('E-mail', 'email', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Telefone', 'telefone', null, ['class' => 'phone-mask']) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Celular', 'celular', null, ['class' => 'phone-mask']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsPassword('Senha', 'password', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsPassword('Confirmação da senha', 'password_confirmation', null, ['maxlength' => 191]) }}
                </div>
            </div>

        @endcomponent
    </div>
    <div class="col-md-3">
        @component('components.box')
            @slot('type', $box_type)
            @slot('icon', 'link')
            @slot('title', 'Ações')

            @slot('body_class', 'padding-30')

            <div class="text-center">
                <button type="submit" class="btn btn-flat btn-block btn-warning btn-toggle">{{ 'Atualizar' }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-toggle">
                    Voltar
                </a>
            </div>
        @endcomponent

        @component('components.box')
            @slot('type', $box_type)
            @slot('icon', 'camera')
            @slot('title', 'Foto')

            @if(isset($result) && $result->imagem)
                @slot('body_class', 'text-center')
            @endif

            @slot('actions')
                @if(isset($result) && $result->imagem && $action == 'edit')
                    <a href="{{ route('usuarios.meusdados.destroyImagem', ['id' => $result->id]) }}"
                       class="btn btn-danger btn-sm btn-del-img">Excluir Imagem</a>
                @endif
            @endslot

            @if(!isset($result) || !$result->imagem)
                {{ Form::bsFile('Imagem', 'file', null, ['id' => 'upload-file-selector']) }}
            @else
                <img src="{{ asset('storage/uploads/usuarios/'.$result->imagem) }}" class="img-circle" alt="User Image">
            @endif

        @endcomponent
    </div>
</div>

@push('js')
<script>
    $(function () {
        $('.btn-del-img').on('click', function(e){
            e.preventDefault();

            var $this = $(this);

            swal({
                title: "Deseja excluir a imagem?",
                text: "Essa ação é irreversível!",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Excluir",
                reverseButtons: true
            }).then(function(result){

                if (result.value) {
                    var url = $this.attr('href');
                    disableButton($this);
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: "_method=DELETE"
                    }).done(function (response) {
                        if (response.success) {
                            window.location = response.redirect;
                        } else {
                            swal("Erro ao tentar excluir!", "Tente novamente mais tarde.", "warning");
                        }
                    });

                }
            });

        });

        $('#upload-file-selector').on('change', function() {
            var filename = $('#upload-file-selector').val().split('\\').pop();
            $('.filename').text(filename);
        });
    });
</script>
@endpush
