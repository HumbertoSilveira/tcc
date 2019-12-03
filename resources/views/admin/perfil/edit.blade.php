@php
    $txt_plural = 'perfis';
    $txt_singular = 'perfil';
@endphp

@extends('adminlte::page')

@section('title', capitalize($txt_plural))

@section('content_header')
    <h1>{{ capitalize($txt_plural) }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li><a href="{{ route(str_slug($txt_plural).'.index', ['id' => $result->id]) }}">Visualizando {{ $txt_singular.' '.strtolower($result->nome) }}</a></li>
        <li class="active">Editando {{ $txt_singular }} {{ strtolower($result->nome) }}</li>
    </ol>
@endsection

@section('content')
    {!! Form::model($result, ['route' => [str_slug($txt_plural).'.update', $result->id], 'method' => 'put', 'autocomplete' => 'off']) !!}

    {!! Form::hidden('redirectUrl', route(str_slug($txt_plural).'.index', ['id' => $result->id] + request()->all())) !!}
        @include('admin.'.str_slug($txt_singular).'.partial.form', ['action' => 'edit', 'box_type' => 'warning'])
    {!! Form::close() !!}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    });
</script>
@endpush
