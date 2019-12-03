@extends('adminlte::page')

@section('title', 'Simular Login')

@section('content_header')
    <h1>Simular Login</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li class="active">Simulando login de usuário</li>
    </ol>
@endsection

@section('content')

    @component('components.box')
        @slot('type', 'primary')
        @slot('icon', 'th-list')
        @slot('title', "Selecione o usuário")
        @slot('body_class', 'no-padding')

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover no-margin grid-table">
                <thead>
                    <tr>
                        <th class="text-center" width="1">Ações</th>
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
                        <td class="nowrap">
                            <a href="{{ route('simular.simular', ['id' => $row->id]) }}" class="btn bg-purple btn-xs btn-flat btn-toggle"> Simular login</a>
                        </td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->nome }}</td>
                        <td>{{ $row->login }}</td>
                        <td>{{ $row->perfis->implode('nome', ', ') }}</td>
                        <td>{{ optional($row->ultimo_acesso)->format('d/m/Y - H:i:s') }}</td>
                        <td>{{ $row->ativo_nome }}</td>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function(){

    });
</script>
@endpush