<div class="row">
    <div class="col-md-9">
        @component('components.box')
            @slot('type', $box_type)
            @slot('title', 'Dados do '.$txt_singular)
            @slot('icon', 'info-circle')

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsText('Nome', 'nome', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Login', 'login', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('CPF', 'cpf', null, ['class' => 'cpf-mask']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsText('E-mail', 'email', null, ['maxlength' => 191]) }}
                </div>
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsSelect('Cor do sistema', 'skin', $opcoes_skin, null, ['class' => 'select2']) }}
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
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Telefone', 'telefone', null, ['class' => 'phone-mask']) }}
                </div>
                <div class="col-xs-12 col-md-3">
                    {{ Form::bsText('Celular', 'celular', null, ['class' => 'phone-mask']) }}
                </div>
                <div class="col-xs-12 col-md-6">
                    {{ Form::bsSelect('Perfil de usuário', 'perfis[]', $opcoes_perfil, null, ['class' => 'select2', 'multiple' => 'multiple']) }}
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
            @slot('icon', 'exchange')
            @slot('title', 'Ativo')

            @slot('body_class', 'padding-30')

            {{ Form::bsSwitch(null, 'ativo', 'S', (isset($result) && $result->ativo == 'S' ? true : false), ['data-size' => 'medium', 'data-on-text' => 'Sim', 'data-off-text' => 'Não', 'id' => 'ativo']) }}

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
                    <a href="{{ route('usuarios.destroyImagem', ['id' => $result->id]) }}"
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
        $('form').on('submit', function(){
            $('#cpf').unmask();
        });
        
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
                    disableButton($this);
                    var url = $this.attr('href');

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
