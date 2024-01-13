@extends('layouts.app')

@section('title', 'editarusuario')

@section('content')


    <div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200
rounded-lg shadow-lg">

        <h1 class="text-3xl text-center font-bold">Editar Usuario</h1>

        <form class="mt-4" method="POST" action="{{ route('admin.actualizausuario', ['id' => $usuario->id]) }}">
            @csrf

            <input type="text"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Name" value="{{ $usuario->name }}" id="name" name="name">

            @error('name')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror

            <input type="email"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Email" id="email" value="{{ $usuario->email }}" name="email">

            @error('email')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror
            <!--
                <input type="text"
                    class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                    placeholder="Password" id="password"  value="{{ $usuario->password }}" name="password">

                @error('password')
        <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                        </p>
    @enderror
                -->
            <input type="text"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="rol" id="rol" value="{{ $usuario->rol }}" name="rol">

            @error('rol')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror

            <button type="submit"
                class="btn btn-primary rounded-md w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Send</button>


        </form>


    </div>


@endsection
