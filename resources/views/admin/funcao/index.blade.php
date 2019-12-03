@php
    $txt_plural = 'funções';
    $txt_singular = 'função';
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

    @include('admin.'.str_slug($txt_singular).'.partial.search')

    @component('components.box')
        @slot('type', 'primary')
        @slot('icon', 'th-list')
        @slot('title', capitalize($txt_plural)." cadastradas")
        @slot('body_class', 'no-padding')

        @slot('actions')

            @if(Gate::allows('cadastrar-gerenciar-'.str_slug($txt_plural)))
                <a href="{{ route(str_slug($txt_plural).'.create') }}" class="btn btn-flat bg-olive btn-sm btn-toggle">
                    <i class="fa fa-plus fa-fw"></i> Adicionar {{ $txt_singular }}
                </a>
            @endif

            @if(Gate::allows('excluir-gerenciar-'.str_slug($txt_plural)))
                <a href="{{ route(str_slug($txt_plural).'.destroy') }}" class="btn btn-flat bg-maroon btn-sm btn-delete-all">
                    <i class="fa fa-times fa-fw"></i> Excluir {{ $txt_singular }}
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
                            @if(Gate::allows('excluir-gerenciar'.str_slug($txt_plural)) && !$row->operacoes_count)
                                <input type="checkbox" name="itens[]" value="{{ $row->id }}" class="select-item">
                            @endif
                        </td>
                        <td>{{ $row->id }}</td>
                        <td>
                            <a href="{{ route(str_slug($txt_plural).'.index', ['id' => $row->id] + request()->all()) }}">
                                {{ $row->nome }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ config('app.messages.grid.empty') }}</td>
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

    @php($model = collect($results->items())->where('id', request('id'))->first())

    @if(!is_null($model))
        @includeWhen(request()->has('id'), 'admin.'.str_slug($txt_singular).'.partial.view', ['model' => $model])
    @endif
@endsection
