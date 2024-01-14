@extends('layouts.app')

@section('title', 'editar')

@section('content')



    <div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200
rounded-lg shadow-lg">

        <h1 class="text-3xl text-center font-bold">Editar Solicitud de credito</h1>

        <form class="mt-4" method="POST" action="{{ route('solicitacredito.update', ['id' => $solicitudcredito->id]) }}">

            @csrf

            <h6 class="text-1xl text-center font-bold">Valor del credito</h6>
            <input type="number" disabled
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Ingresa el valor del credito" value="{{ $solicitudcredito->valor_credito }}" id="valor_credito"
                name="valor_credito">

            @error('valor_credito')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <h6 class="text-1xl text-center font-bold">Cuotas</h6>
            <input type="number" disabled
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Ingresa la cantidad de cuotas" value="{{ $solicitudcredito->cuotas }}" id="cuotas"
                name="cuotas">

            @error('cuotas')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror





            <h6 class="text-1xl text-center font-bold">Descripción</h6>
            <textarea id="descripcion" disabled
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                name="descripcion" rows="4" cols="50">
    {{ $solicitudcredito->descripcion }}
</textarea>


            @error('descripcion')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror




            <h6 class="text-1xl text-center font-bold">Estado</h6>

            <select id="estado" name="estado" value="{{ $solicitudcredito->estado }}"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
            text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">
                <option value="{{ $solicitudcredito->estado }}">Selecciona el estado </option>
                @if (auth()->check() && (auth()->user()->rol == 'gerente' || auth()->user()->rol == 'asesor'))
                    <option value="A">Aprobado</option>
                    <option value="R">Rechazado</option>
                @else
                    <option value="C">Cancelado</option>
                @endif

            </select>

            @error('estado')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
  text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror



            <h6 class="text-1xl text-center font-bold">Fecha de Solicitud</h6>

            <!-- Campo de entrada para la fecha -->
            <input type="date" id="fecha_solicitud" name="fecha_solicitud" disabled
                value="{{ \Carbon\Carbon::parse($solicitudcredito->fecha_solicitud)->format('Y-m-d') }}"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
                    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">

            @error('fecha_solicitud')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
  text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror




            <h6 class="text-1xl text-center font-bold">Tipo de credito</h6>

            <select id="tipo_credito_id" name="tipo_credito_id" disabled value="{{ $solicitudcredito->tipo_credito_id }}"
                class="border border-gray-200 rounded-md bg-gray-200 w-full
        text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">


                @foreach ($tipocredito as $tipo)
                    <option value="{{ $tipo->id }}"
                        {{ $tipo->id == $solicitudcredito->tipo_credito_id ? 'selected' : '' }}>
                        {{ $tipo->nombrecredito }}
                    </option>
                @endforeach

            </select>

            @error('tipo_credito_id')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
  text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror



            <h6 class="text-1xl text-center font-bold">Observaciones del asesorn</h6>
            <textarea id="observaciones_asesor" disabled
                class="border border-gray-200 rounded-md bg-gray-200 w-full
    text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                name="observaciones_asesor" rows="4" cols="50">
    {{ $solicitudcredito->observaciones_asesor }}
</textarea>

            @error('descripcion')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}
                </p>
            @enderror


            <button type="submit"
                class="btn btn-primary rounded-md w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Actualizar
                solicitud</button>

        </form>

    </div>

@endsection
