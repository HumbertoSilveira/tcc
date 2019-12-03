@extends('adminlte::page')

@section('title', "Meus Dados")

@section('content_header')
    <h1>Meus Dados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li><a href="{{ route('usuarios.index', ['id' => $result->id]) }}">Usuários</a></li>
        <li class="active">Editando meus dados</li>
    </ol>
@endsection

@section('content')
    {!! Form::model($result, ['route' => ['usuarios.meusdados.update'], 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        @include('admin.usuario.partial.form_dados', ['action' => 'edit', 'box_type' => 'warning'])
    {!! Form::close() !!}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    });
</script>
@endpush
