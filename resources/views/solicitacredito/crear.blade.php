@extends('layouts.app')

@section('title', 'crear')

@section('content')



    <div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200
rounded-lg shadow-lg">

        <h1 class="text-3xl text-center font-bold">Solicitud de credito</h1>

        <form class="mt-4" method="POST" action="{{ route('solicitacredito.store') }}">

            @csrf


           <!-- <h6 class="text-1xl text-center font-bold">cliente_id</h6>  -->
            <input type="hidden"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="cliente_id" id="cliente_id" value="{{ auth()->user()->id }}" name="cliente_id">

            @error('cliente_id')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <h6 class="text-1xl text-center font-bold">Valor del credito</h6>
            <input type="number"  required
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Ingresa el valor del credito" id="valor_credito" name="valor_credito">

            @error('valor_credito')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <h6 class="text-1xl text-center font-bold">Cuotas</h6>
            <input type="number"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Ingresa la cantidad de cuotas" id="cuotas" name="cuotas" required>

            @error('cuotas')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <h6 class="text-1xl text-center font-bold">Descripcion</h6>
            <textarea id="descripcion" required
                class="border border-gray-200 rounded-md bg-gray-200 w-full
            text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                name="descripcion" rows="4" cols="50"></textarea>

            @error('descripcion')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <h6 class="text-1xl text-center font-bold">Fecha de solicitud</h6>

            <input type="datetime-local" id="fecha_solicitud" name="fecha_solicitud" required
                class="border border-gray-200 rounded-md bg-gray-200 w-full
        text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">

            @error('fecha_solicitud')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
  text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror




            <h6 class="text-1xl text-center font-bold">Tipo de credito</h6>

            <select id="tipo_credito_id" name="tipo_credito_id"  required
                class="border border-gray-200 rounded-md bg-gray-200 w-full
        text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">

                @foreach ($tipocredito as $tipo)
                    <option value="{{ $tipo->id }}"> {{ $tipo->nombrecredito }}</option>
                @endforeach

            </select>

            @error('tipo_credito_id')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
  text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror



            <h6 class="text-1xl text-center font-bold">Observaciones del asesor</h6>
            <textarea id="observaciones_asesor"  required
                class="border border-gray-200 rounded-md bg-gray-200 w-full
            text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                name="observaciones_asesor" rows="4" cols="50"></textarea>

            @error('descripcion')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <button type="submit"
                class="btn btn-primary rounded-md w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Solicitar</button>

        </form>

    </div>

@endsection
