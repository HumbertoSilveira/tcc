@php
    $txt_plural = 'usuários';
    $txt_singular = 'usuário';
@endphp

@extends('adminlte::page')

@section('title', capitalize($txt_plural))

@section('content_header')
    <h1>{{ capitalize($txt_plural) }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li class="active">{{ capitalize($txt_plural) }} do sistema</li>
    </ol>
@endsection

@section('content')

    @component('components.box')
        @slot('type', 'primary')
        @slot('icon', 'th-list')
        @slot('title', capitalize($txt_plural)." cadastrados")
        @slot('body_class', 'no-padding')

        @slot('actions')

            @if(Gate::allows('cadastrar-'.str_slug($txt_plural)))
                <a href="{{ route('usuarios.create') }}" class="btn btn-flat bg-olive btn-sm btn-toggle">
                    <i class="fa fa-plus fa-fw"></i> Adicionar usuário
                </a>
            @endif

            @if(Gate::allows('excluir-'.str_slug($txt_plural)))
                <a href="{{ route('usuarios.destroy') }}" class="btn btn-flat bg-maroon btn-sm btn-delete-all">
                    <i class="fa fa-times fa-fw"></i> Excluir selecionados
                </a>
            @endif
        @endslot

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover no-margin grid-table">
                <thead>
                    <tr>
                        <th width="1"><input type="checkbox" id="select-all-items"></th>
                        <th width="1">ID</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Perfil</th>
                        <th>Último acesso</th>
                        <th>Ativo</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($results as $row)
                    @php
                        $class = '';
                        if ($row->id == request('id')) {
                            $class = ' active';
                        }
                    @endphp
                    <tr class="{{ $class }}">
                        <td class="no-row-link">
                            @if(Gate::allows('excluir-'.str_slug($txt_plural)))
                                <input type="checkbox" name="itens[]" value="{{ $row->id }}" class="select-item">
                            @endif
                        </td>
                        <td>{{ $row->id }}</td>
                        <td>
                            <a href="{{ route('usuarios.index', ['id' => $row->id] + request()->all()) }}">
                                {{ $row->nome }}
                            </a>
                        </td>
                        <td>{{ $row->login }}</td>
                        <td>{{ $row->perfis->implode('nome', ', ') }}</td>
                        <td>{{ optional($row->ultimo_acesso)->format('d/m/Y - H:i:s') }}</td>
                        <td>
                            <input data-id="{{ $row->id }}" data-size="mini" data-on-text="Sim" data-off-text="Não" class="bs-switch switch-ativo" {{ $row->isAtivo() ? 'checked' : '' }} value="S" type="checkbox">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ config('app.messages.grid.empty') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($results->count())
            @slot('footer')
                {{-- PAGINAÇÃO --}}
                <div class="text-right">
                    {{ $results->appends(request()->except('page'))->links() }}
                </div>
            @endslot
        @endif
    @endcomponent

    @php
        $model = collect($results->items())->where('id', request('id'))->first();
    @endphp
    @if(!is_null($model))
        @includeWhen(request()->has('id'), 'admin.'.str_slug($txt_singular).'.partial.view', ['model' => $model])
    @endif
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.switch-ativo').on('switchChange.bootstrapSwitch', function(event, state) {
            var $this = $(this);
            var id = $this.attr('data-id');
            var url = "{{ url('/admin/usuarios') }}/"+id+"/ativo";

            $.ajax({
                method: "PUT",
                url: url,
                data: "_method=PUT"
            }).done(function (response) {
                if (response.success) {
                    window.location = response.redirect;
                } else {
                    swal("Erro ao tentar excluir!", "Tente novamente mais tarde.", "warning");
                }
            });
        });
    });
</script>
@endpush