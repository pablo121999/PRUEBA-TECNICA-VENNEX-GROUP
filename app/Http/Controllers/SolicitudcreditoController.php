<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\credito;

use App\Models\tipocredito;
use App\Models\solicitudcredito;
use Illuminate\Http\Request;

class SolicitudcreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->check() && (auth()->user()->rol == 'gerente' || auth()->user()->rol == 'admin' || auth()->user()->rol == 'asesor')) {
            $solicitud['solicitudcredito'] = solicitudcredito::all();
        } else {

            // Obtener el ID del usuario autenticado
            $clienteId = auth()->user()->id;
            // Obtener todas las solicitudes de crédito asociadas al cliente, que no estén en estado 'A'
            $solicitud['solicitudcredito'] = solicitudcredito::where('cliente_id', $clienteId)
            ->where('estado', '!=', 'A')
            ->get();
        }



        $user['user'] = User::all();
        $tipocredito['tipocredito'] = tipocredito::all();

        // Combinar $datos y $tipocredito en un solo array
        $Data = array_merge($solicitud, $user, $tipocredito);

        // Pasar el array combinado a la vista
        return view('solicitacredito/index', $Data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datos['tipocredito'] = tipocredito::all();
        return view('solicitacredito/crear', $datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $solicitudcredito = $request->except('_token');

        //  var_dump($solicitudcredito ); die;
        $solicitud = new solicitudcredito();
        $solicitud->cliente_id = $solicitudcredito['cliente_id'];
        $solicitud->valor_credito = $solicitudcredito['valor_credito'];
        $solicitud->cuotas = $solicitudcredito['cuotas'];
        $solicitud->descripcion = $solicitudcredito['descripcion'];
        $solicitud->estado = $solicitudcredito['estado'] ?? null;
        $solicitud->fecha_solicitud = $solicitudcredito['fecha_solicitud'];
        $solicitud->tipo_credito_id = $solicitudcredito['tipo_credito_id'];
        $solicitud->observaciones_asesor = $solicitudcredito['observaciones_asesor'];

        $solicitud->save();

        return redirect()->route('solicitacredito.index');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(solicitudcredito $solicitudcredito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datos['solicitudcredito'] = solicitudcredito::find($id);
        $tipocredito['tipocredito'] = tipocredito::all();

        if (!$datos['solicitudcredito']) {
            // Puedes manejar el caso en el que el usuario no existe, por ejemplo, redirigiendo a otra página o mostrando un error.
            return redirect()->route('solicitacredito.index');
        }

        // Combinar $datos y $tipocredito en un solo array
        $mergedData = array_merge($datos, $tipocredito);

        // Pasar el array combinado a la vista
        return view('solicitacredito.editar', $mergedData);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $solicitud = $request->except('_token');

        $solicitudcredito = solicitudcredito::find($id);
        // var_dump($solicitudcredito); die;
        if (!$solicitudcredito) {
            // Manejar el caso en el que el usuario no existe
            return redirect()->route('solicitacredito.index')->with('error', 'Usuario no encontrado');
        }

        /*  $solicitudcredito->valor_credito = $solicitud['valor_credito'];
          $solicitudcredito->cuotas = $solicitud['cuotas'];
          $solicitudcredito->descripcion = $solicitud['descripcion']; */
        $solicitudcredito->estado = $solicitud['estado'];
        /*  $solicitudcredito->fecha_solicitud = $solicitud['fecha_solicitud'];
          $solicitudcredito->tipo_credito_id = $solicitud['tipo_credito_id'];
          $solicitudcredito->observaciones_asesor = $solicitud['observaciones_asesor']; */

        $solicitudcredito->update();


        if (auth()->check() && (auth()->user()->rol == 'gerente' || auth()->user()->rol == 'asesor')) {

            // Consultar solicitudes en estado A aprobadas
            $solicitudesEnEstadoA = solicitudcredito::where('estado', 'A')->get();
            $creditos = credito::all();
            $tipocredito = tipocredito::all();

            // Guardar créditos aprobados en crédito
            if ($solicitudesEnEstadoA) {
                foreach ($solicitudesEnEstadoA as $soli) {
                    // Buscar un crédito que coincida con la solicitud actual
                    $creditoCoincidente = $creditos->first(function ($credito) use ($soli) {
                        return $credito->valor_credito == $soli->valor_credito &&
                            $credito->numero_cuotas == $soli->cuotas &&
                            $credito->cliente_id == $soli->cliente_id &&
                            $credito->fecha_aprobacion == $soli->updated_at;
                    });

                    // Si no hay un crédito coincidente, crear uno nuevo
                    if (!$creditoCoincidente) {
                        $numeroleatorio_cuentabancaria = rand(1000000000, 9999999999);

                        $credito = new credito();
                        $credito->numero_cuenta = $numeroleatorio_cuentabancaria;
                        $credito->valor_credito = $soli->valor_credito;
                        $credito->numero_cuotas = $soli->cuotas;

                        // Buscar el tipo de crédito correspondiente en la colección de tipos de crédito
                        $tipoCredito = $tipocredito->firstWhere('id', $soli->tipo_credito_id);

                        // Verificar si se encontró el tipo de crédito
                        if ($tipoCredito) {
                            // Calcular el valor total de cada cuota, incluyendo el interés
                            $valorTotalCuota = $soli->valor_credito * (1 + ($tipoCredito->interes / 100)) / $soli->cuotas;
                            $credito->valor_cuota = $valorTotalCuota;
                        }

                        $credito->cliente_id = $soli->cliente_id;
                        $credito->fecha_aprobacion = $soli->updated_at;
                        $credito->quien_aprobo_id = auth()->user()->id;
                        $credito->tipo_credito_id = $soli->tipo_credito_id;

                        $credito->save();
                    }
                }
            }

        }

        return redirect()->route('solicitacredito.index')->with('success', 'Usuario actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $solicitudcredito = solicitudcredito::find($id);

        if (!$solicitudcredito) {
            // Manejar el caso en el que el usuario no existe
            return redirect()->route('solicitacredito.index')->with('error', 'Usuario no encontrado');
        }

        $solicitudcredito->delete();

        return redirect()->route('solicitacredito.index')->with('success', 'Usuario eliminado correctamente');
    }
}
