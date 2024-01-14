@extends('layouts.app')
@section('title', 'Home')
@section('content')


    <link rel="stylesheet" href="{{ asset('css/home.css') }}">


    <div class="text-center">
        <h1 class="text-5xl pt-19">Welcome to the Bank</h1>

        <img src="https://cdn-icons-png.flaticon.com/512/3635/3635995.png" class="mx-auto mt-8" alt="Descripción de la imagen">

        <ul class="flex justify-center mt-8 space-x-4">
            <li><a href="{{ route('credito.index') }}" class="btn btn-success">Ver Créditos</a></li>
            <li><a href="{{ route('solicitacredito.index') }}" class="btn btn-warning">Solicitar Crédito</a></li>

        </ul>
    </div>



    <div class="chat-container">
        <div class="chat-header">
            <h5>🤖<p><strong> OpenAI</p></strong></h5>
        </div>
        <div class="chat-messages" id="chat-container">
            <!-- Aquí se mostrarán las preguntas y respuestas -->
        </div>
        <div class="chat-input">
            <input id="input-question" class="form-control" type="text" placeholder="Realiza una pregunta">
            <input id="usuarionombre" class="form-control" value="{{ auth()->user()->name }}" type="hidden" >
            <button id="submit-button" class="submit-button">

              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
              </svg>
            </button>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{ asset('js/home.js') }}"></script>
@endsection
