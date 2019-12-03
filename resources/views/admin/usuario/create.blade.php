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
        <li><a href="{{ route('usuarios.index') }}">{{ capitalize($txt_plural) }} cadastrados</a></li>
        <li class="active">Adicionando novo {{ $txt_singular }}</li>
    </ol>
@endsection

@section('content')
    {!! Form::open(['route' => str_slug($txt_plural).'.store', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        @include('admin.'.str_slug($txt_singular).'.partial.form', ['action' => 'create', 'box_type' => 'primary'])
    {!! Form::close() !!}
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $("#nome").focus().select();
    });
</script>
@endpush