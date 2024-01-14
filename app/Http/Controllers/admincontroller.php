<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    public function index()
    {

        if (auth()->check() && (auth()->user()->rol == 'gerente')) {
            // Buscar todos los usuarios cuyo rol no sea 'admin'
            $datos['usuarios'] = User::where('rol', '!=', 'admin')->get();
        } else {
            $datos['usuarios'] = User::all();
        }

        return view('admin/index', $datos);
    }

    public function registro_usuario()
    {
        return view('admin/registrousuario');
    }



    public function store(Request $request)
    {

        $datosusuarios = $request->except('_token');

        $usuarios = new user();
        $usuarios->name = $datosusuarios['name'];
        $usuarios->email = $datosusuarios['email'];
        $usuarios->password = $datosusuarios['password'];
        $usuarios->rol = $datosusuarios['rol'];

        $usuarios->save();

        return redirect()->route('admin.index');

        // return response()->json($datosusuarios);
    }


    public function editarUsuario($id)
    {
        $datos['usuario'] = User::find($id);

        if (!$datos['usuario']) {
            // Puedes manejar el caso en el que el usuario no existe, por ejemplo, redirigiendo a otra página o mostrando un error.
            return redirect()->route('admin.index');
        }

        return view('admin.editarusuario', $datos);
    }

    public function actualizausuario(Request $request, $id)
    {

        $datosusuarios = $request->except('_token');

        $usuario = User::find($id);

        if (!$usuario) {
            // Manejar el caso en el que el usuario no existe
            return redirect()->route('admin.index')->with('error', 'Usuario no encontrado');
        }

        $usuario->name = $datosusuarios['name'];
        $usuario->email = $datosusuarios['email'];
        // $usuario->password = $datosusuarios['password'];
        $usuario->rol = $datosusuarios['rol'];

        $usuario->update();

        return redirect()->route('admin.index')->with('success', 'Usuario actualizado correctamente');


        // return response()->json($datosusuarios);
    }


    public function eliminaUsuario($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            // Manejar el caso en el que el usuario no existe
            return redirect()->route('admin.index')->with('error', 'Usuario no encontrado');
        }

        $usuario->delete();

        return redirect()->route('admin.index')->with('success', 'Usuario eliminado correctamente');
    }



}
