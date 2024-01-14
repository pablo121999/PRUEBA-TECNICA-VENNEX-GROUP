@extends('layouts.app')

@section('title', 'index')

@section('content')

    <br>
    <h1 style="text-align: center; font-weight: bold;">Créditos aprobados</h1>
    <br>

    <div class="container">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Numero de cuenta</th>
                    <th scope="col">Valor del crédito</th>
                    <th scope="col">Cuotas</th>
                    <th scope="col">Valor de cuota</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha de aprobación</th>
                    <th scope="col">quien aprobó</th>
                    <th scope="col">tipo de crédito</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($creditos as $credito)
                    <tr>
                        <th scope="row">{{ $credito->id }}</th>
                        <td>{{ $credito->numero_cuenta  }}</td>
                        <td>${{ number_format($credito->valor_credito, 0, ',', '.') }}</td>

                        <td>{{ $credito->numero_cuotas  }}</td>
                       
                        <td>${{ number_format($credito->valor_cuota, 0, ',', '.') }}</td>

                        @foreach ($user as $u)
                            @if ($credito->cliente_id == $u->id)
                                <td>{{ $u->name }}</td>
                                @php
                                    $foundMatch = true;
                                    break; // Termina el bucle una vez que se ha encontrado una coincidencia
                                @endphp
                            @endif
                        @endforeach

                        <td>{{ $credito->fecha_aprobacion  }}</td>


                        @foreach ($user as $u)
                        @if ($credito->quien_aprobo_id == $u->id)
                            <td>{{ $u->name }}</td>
                            @php
                                $foundMatch = true;
                                break; // Termina el bucle una vez que se ha encontrado una coincidencia
                            @endphp
                        @endif
                    @endforeach



                        @foreach ($tipocredito as $tipo)
                        @if ($credito->tipo_credito_id == $tipo->id)
                            <td>{{ $tipo->nombrecredito }}</td>
                            @php
                                $foundMatch = true;
                                break; // Termina el bucle una vez que se ha encontrado una coincidencia
                            @endphp
                        @endif
                    @endforeach


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


@endsection
