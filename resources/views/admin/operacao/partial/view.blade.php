@component('components.box')
    @slot('type', 'primary')
    @slot('icon', 'eye')
    @slot('title', 'Visualizando '.$txt_plural)
    @slot('body_class', 'clearfix')
    
    @if(Gate::allows('editar-'.str_slug($txt_plural)))
        <a href="{{ route(str_slug($txt_plural).'.edit', ['id' => $model->id]) }}" class="btn btn-app">
            <i class="fa fa-pencil  "></i>
            Editar {{ $txt_singular }}
        </a>
    @endif

    @if(Gate::allows('excluir-'.str_slug($txt_plural)))
        <a href="#" type="button" class="btn btn-app btn-delete">
            <i class="fa fa-trash"></i>
            Excluir {{ $txt_singular }}
        </a>
    @endif

    <a href="{{ route(str_slug($txt_plural).'.atribuicoes', ['id' => $model->id]) }}" class="btn btn-app">
        <i class="fa fa-users"></i>
        Atribuições da equipe
    </a>
    <a href="{{ route(str_slug($txt_plural).'.atribuicoes', ['id' => $model->id]) }}" class="btn btn-app">
        <i class="fa fa-clipboard"></i>
        Documentos
    </a>
    
    <br><br>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-gray-light" colspan="2">{{ $model->nome }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>ID:</strong> {{ $model->id}}
                </td>
                <td>
                    <strong>Equipe responsável:</strong> {{ $model->equipe->nome }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Criado em:</strong> {{ $model->created_at->format('d/m/Y') }}
                </td>
                <td>
                    <strong>Criado por:</strong> {{ $model->usuario->nome }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Descrição:</strong> <br> {!! $model->descricao_site !!}
                </td>
            </tr>
        </tbody>
    </table>
    
    @if($model->atribuicoes->count())
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-gray text-center" colspan="3">Funções atribuídas</th>
                </tr>
                <tr class="bg-gray-light">
                    <th>Agente</th>
                    <th>Função</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model->atribuicoes as $atribuicao)
                <tr>
                    <td>{{ $atribuicao->agente }}</td>
                    <td>{{ $atribuicao->funcao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endcomponent

@push('js')
    <script>
        $(document).ready(function(){
            $('.btn-delete').on('click', function(e){
                e.preventDefault();
                swal({
                    title: "Deseja realmente excluir?",
                    text: "Essa ação é irreversível!",
                    type: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Excluir",
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        disableButton($('.btn-delete'), 'spinner');
                        let url = "{{ route('operacoes.destroy') }}";
                        let data = {
                            params: {
                                itens: ["{{ request('id') }}"]
                            }
                        };
                        axios.delete(url, data).then((response) => {
                            if(response.data.success)
                                window.location.href = response.data.redirect;
                            else
                                swal("Erro", response.data.mensagem, "error");
                        }).catch(function(error){
                            swal("Erro", error.response.statusText, "error");
                        });
                    }
                });
            });
        });
    </script>
@endpush