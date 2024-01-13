@extends('layouts.app')
@section('title', 'Home')
@section('content')


<div class="text-center">
    <h1 class="text-5xl pt-24">Welcome to the Bank</h1>

    <img src="https://cdn-icons-png.flaticon.com/512/3635/3635995.png" class="mx-auto mt-8" alt="Descripción de la imagen">

    <ul class="flex justify-center mt-8 space-x-4">
        <li><a href="" class="btn btn-primary">Ver Créditos</a></li>
        <li><a href="{{ route('solicitacredito.index') }}" class="btn btn-primary">Solicitar Crédito</a></li>

    </ul>
</div>

@endsection
