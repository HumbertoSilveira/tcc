@php
    $txt_plural = 'operações';
    $txt_singular = 'operação';
@endphp

@extends('adminlte::page')

@section('title', capitalize($txt_plural))

@section('content_header')
    <h1>{{ capitalize($txt_plural) }}<small>Gerenciando operações</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li class="active">{{ capitalize($txt_plural) }} do sistema</li>
    </ol>
@endsection

@push('css')
<style>

</style>
@endpush

@section('content')
    
    @include('admin.'.str_slug($txt_singular).'.partial.search')
    
    @component('components.box')
        @slot('type', 'primary')
        @slot('icon', 'th-list')
        @slot('title', capitalize($txt_plural)." cadastradas")
        
        @slot('actions')
            @if(Gate::allows('cadastrar-'.str_slug($txt_plural)))
                <a href="{{ route(str_slug($txt_plural).'.create') }}" class="btn btn-flat bg-olive btn-sm btn-toggle">
                    <i class="fa fa-plus fa-fw"></i> Adicionar {{ $txt_singular }}
                </a>
            @endif
        @endslot
        
        <div class="row">
            @foreach($results as $result)
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <a href="{{ route('operacoes.index', ['id' => $result->id]) }}">
                        <div class="info-box bg-blue-active">
                            <span class="info-box-icon text-light-blue"><i class="fa fa-folder"></i></span>
                            <div class="info-box-content">
                                <br>
                                <span class="info-box-number">{{ $result->nome }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
        @if($results->count())
            @slot('footer')
                {{-- PAGINAÇÃO --}}
                <div class="text-right">
                    {{ $results->appends(request()->except('page'))->links() }}
                </div>
            @endslot
        @else
            <div class="well well-sm text-center">{{ config('app.messages.grid.empty') }}</div>
        @endif
    @endcomponent

    @php($model = collect($results->items())->where('id', request('id'))->first())

    @if(!is_null($model))
        @includeWhen(request()->has('id'), 'admin.'.str_slug($txt_singular).'.partial.view', ['model' => $model])
    @endif
@endsection
