<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{

    public function create()
    {

        return view('auth.login');
    }

    public function store()
    {

        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo electrónico o la contraseña son incorrectos, inténtalo de nuevo.',
            ]);

        } else {

            if (auth()->check() && (auth()->user()->rol == 'admin')) {
                return redirect()->route('admin.index');
            } else if (auth()->check() && (auth()->user()->rol == 'gerente')) {
                return redirect()->to('/');
            } else {
                return redirect()->to('/');
            }
        }
    }

    public function destroy()
    {

        auth()->logout();

        return redirect()->to('/');
    }
}
