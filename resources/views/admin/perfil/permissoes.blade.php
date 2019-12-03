@extends('adminlte::page')

@section('title', "Permissões de perfil")

@section('content_header')
    <h1>{{ 'Permissões do perfil '.strtolower($result->nome) }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li><a href="{{ route('perfis.index', ['id' => $result->id]) }}">Visualizando perfil {{ strtolower($result->nome) }}</a></li>
        <li class="active">Definindo permissões</li>
    </ol>
@endsection

@section('content')
    {!! Form::model($result, ['route' => ['perfis.permissoes', $result->id], 'method' => 'put', 'autocomplete' => 'off']) !!}

    {!! Form::hidden('redirectUrl', route('perfis.index', ['id' => $result->id] + request()->all())) !!}

    <div class="row">
        <div class="col-xs-12 col-md-9">
            @include('admin.perfil.partial.form_permissoes')
        </div>
        <div class="col-xs-12 col-md-3">
            @component('components.box')
                @slot('type', 'warning')
                @slot('icon', 'link')
                @slot('title', 'Ações')

                @slot('body_class', 'padding-30')

                <div class="text-center">
                    {!! Form::button('Marcar/Desmarcar todas', ['class' => 'btn bg-maroon btn-block btn-all-permissions']) !!}
                    <button type="submit" class="btn btn-flat btn-block btn-warning btn-toggle">{{ 'Atualizar permissões' }}</button>
                    {!! link_to_route('perfis.index', 'Voltar', ['id' => $result->id] + request()->all(), ['class' => 'btn btn-default btn-block btn-toggle']) !!}
                </div>
            @endcomponent
        </div>
    </div>

    {!! Form::close() !!}
@endsection
