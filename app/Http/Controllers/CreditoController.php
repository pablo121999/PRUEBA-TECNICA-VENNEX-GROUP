<?php

namespace App\Http\Controllers;
use App\Models\tipocredito;
use App\Models\User;
use App\Models\credito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->check() && (auth()->user()->rol == 'gerente' || auth()->user()->rol == 'admin' || auth()->user()->rol == 'asesor')) {
            $creditos['creditos'] = credito::all();
        } else {

            // Obtener el ID del usuario autenticado
            $clienteId = auth()->user()->id;
            // Obtener todas las solicitudes de crédito asociadas al cliente
            $creditos['creditos'] = credito::where('cliente_id', $clienteId)->get();
        }

        $user['user'] = User::all();
        $tipocredito['tipocredito'] = tipocredito::all();

        // Combinar $datos y $tipocredito en un solo array
        $Data = array_merge($creditos, $user, $tipocredito);

        // Pasar el array combinado a la vista
        return view('credito/index', $Data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(credito $credito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(credito $credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, credito $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(credito $credito)
    {
        //
    }
}
