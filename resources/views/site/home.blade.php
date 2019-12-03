@extends('site.master')

@section('page-title', 'Home')
@section('page-description', 'Home')
@section('page-image', asset('assets/imagens/img-facebook.jpg'))

@section('content')
    <div class="container">
        <br><br>
        <div class="alert alert-success" role="alert">
            Template com framework Laravel versão: <strong>{{ app()::VERSION }}</strong><br>
            Para acessar a área administrativa clique <a href="{{ route('login') }}">aqui</a>
        </div>
    </div>
@endsection