<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SolicitudcreditoController;


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

//envia formulario de registro
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');



Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

//login formulario de registro
Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');



Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');


Route::get('/registrousuario', [AdminController::class, 'registro_usuario'])
    ->middleware('auth.admin')
    ->name('admin.registrousuario');

Route::post('/registrousuario', [AdminController::class, 'store'])
    ->name('admin.store');

Route::get('/editarusuario/{id}', [AdminController::class, 'editarUsuario'])
    ->middleware('auth.admin')
    ->name('admin.editarusuario');

    Route::post('/actualizausuario/{id}', [AdminController::class, 'actualizausuario'])
    ->name('admin.actualizausuario');

    Route::post('/eliminar/{id}', [AdminController::class, 'eliminaUsuario'])
    ->name('admin.eliminausuario');


    Route::get('/solicitacredito', [SolicitudcreditoController::class, 'index'])
    ->middleware('auth')
    ->name('solicitacredito.index');


    Route::get('/solicitacreditocreate', [SolicitudcreditoController::class, 'create'])
    ->middleware('auth')
    ->name('solicitacredito.create');

    Route::post('/solicitacreditostore', [SolicitudcreditoController::class, 'store'])
    ->middleware('auth')
    ->name('solicitacredito.store');


    Route::get('/solicitacreditoedit/{id}', [SolicitudcreditoController::class, 'edit'])
    ->middleware('auth')
    ->name('solicitacredito.edit');

    Route::post('/solicitacreditoupdate/{id}', [SolicitudcreditoController::class, 'update'])
    ->name('solicitacredito.update');


    Route::get('/solicitacrediteliminar/{id}', [SolicitudcreditoController::class, 'destroy'])
    ->name('solicitacredito.destroy');

/*
    Route::get('/solicitacreditoupdate/{id}', [SolicitudcreditoController::class, 'update'])
    ->middleware('auth')
    ->name('solicitacredito.update'); */






/*
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');  */
