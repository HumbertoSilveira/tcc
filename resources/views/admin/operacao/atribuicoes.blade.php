@php
    $txt_plural = 'operações';
    $txt_singular = 'operação';
@endphp

@extends('adminlte::page')

@section('title', capitalize($txt_plural))

@section('content_header')
    <h1>{{ capitalize($txt_plural) }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li><a href="{{ route(str_slug($txt_plural).'.index') }}">{{ capitalize($txt_plural) }} do sistema</a></li>
        <li class="active">Editando atribuições</li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-9">
            @component('components.box')
                @slot('type', 'warning')
                @slot('title', 'Dados da '.$txt_singular)
                @slot('icon', 'info-circle')
        
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center bg-gray-light" colspan="2">{{ $result->nome }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <strong>ID:</strong> {{ $result->id}}
                        </td>
                        <td>
                            <strong>Equipe responsável:</strong> {{ $result->equipe->nome }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Criado em:</strong> {{ $result->created_at->format('d/m/Y') }}
                        </td>
                        <td>
                            <strong>Criado por:</strong> {{ $result->usuario->nome }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Descrição:</strong> <br> {!! $result->descricao_site !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
        
            @endcomponent
    
            <div id="app-funcoes">
                @component('components.box')
                    @slot('type', 'warning')
                    @slot('title', 'Funções')
                    @slot('icon', 'address-card-o')
                    @slot('box_class', 'app-box')
                    
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="agentes">Agentes</label><br>
                                <select class="form-control" v-model="agente" id="agentes">
                                    <option value="" disabled>Selecione um agente</option>
                                    @foreach($agentes as $value => $text)
                                        <option value="{{ $value }}">{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="agentes">Funções</label><br>
                                <select class="form-control" v-model="funcao" id="funcoes">
                                    <option value="" disabled>Selecione uma função</option>
                                    @foreach($funcoes as $value => $text)
                                        <option value="{{ $value }}">{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>&nbsp;</label> <br>
                                <button type="button" class="btn btn-flat bg-olive btn-block btn-atribuir" @click="atribuir">
                                    Atribuir
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-gray text-center" colspan="3">Funções atribuídas</th>
                                    </tr>
                                    <tr class="bg-gray-light">
                                        <th>Agente</th>
                                        <th>Função</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(atribuicao, idx) in atribuicoes" :key="idx">
                                        <td>@{{ atribuicao.agente }}</td>
                                        <td>@{{ atribuicao.funcao }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-flat btn-sm" @click="remover(atribuicao.id)">
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="!atribuicoes.length">
                                        <td colspan="3" class="text-center">Nenhum registro encontrado</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
        <div class="col-md-3">
            @component('components.box')
                @slot('type', 'warning')
                @slot('icon', 'link')
                @slot('title', 'Ações')
            
                @slot('body_class', 'padding-30')
            
                <div class="text-center">
                    {!! link_to_route(str_slug($txt_plural).'.index', 'Voltar', ['id' => $result->id] + request()->all(), ['class' => 'btn btn-default btn-block btn-toggle']) !!}
                </div>
            @endcomponent
        
            @component('components.box')
                @slot('type', 'warning')
                @slot('icon', 'users')
                @slot('title', 'Equipe')
            
                <div class="alert alert-info text-center no-margin">
                    {{ $result->equipe->nome }}
                </div>
        
            @endcomponent
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el: '#app-funcoes',
            data: {
                agente: '',
                funcao: '',
                atribuicoes: @json($result->atribuicoes)
            },
            methods: {
                atribuir() {
                    if(this.agente === "" || this.funcao === "")
                        swal('Atenção', 'Você deve informar o agente e a função para atribuir', 'warning');
                    let url = "{{ route('operacoes.atribuicoes.add', ['id' => $result->id]) }}";
                    let data = {
                        agente_id: this.agente,
                        funcao_id: this.funcao
                    };
                    let btn = $('.btn-atribuir');
                    disableButton(btn, 'spinner');
                    axios.post(url, data).then((response) => {
                        if(response.data.sucesso)
                            this.atribuicoes = response.data.atribuicoes;
                        else
                            swal("Erro", response.data.mensagem, "error");
                    }).catch(function(error){
                        swal("Erro", error.response.statusText, "error");
                    }).then(() => {
                        this.agente = "";
                        this.funcao = "";
                        enableButton(btn);
                    });
                },
                remover(id) {

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
                            let url = "{{ route('operacoes.atribuicoes.destroy', ['id' => $result->id]) }}";
                            let data = {
                                params: {
                                    atribuicao_id: id
                                }
                            };
                            axios.delete(url, data).then((response) => {
                                if(response.data.sucesso)
                                    this.atribuicoes = response.data.atribuicoes;
                                else
                                    swal("Erro", response.data.mensagem, "error");
                            }).catch(function(error){
                                swal("Erro", error.response.statusText, "error");
                            });
                        }
                    });
                }
            }
        });
        $(document).ready(function () {
        });
    </script>
@endpush
