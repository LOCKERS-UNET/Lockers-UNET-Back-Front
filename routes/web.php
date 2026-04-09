<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuscarUsuarioController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

//Rutas para los que esten AUTENTICADOS

Route::middleware(['auth'])->group(function(){

    Route::inertia('/','Home')->name('home');
    Route::inertia('/user-profile','User/Profile')->name('user-profile');
    Route::get('/edit-profile',[PerfilController::class,'index'])->name('editar-perfil');
    Route::post('/edit-profile',[PerfilController::class,'store']);


    Route::inertia('/mi-locker','User/MiLocker')->name('mi-locker'); //LISTO
    Route::inertia('/notificaciones','User/Notificaciones')->name('notificaciones'); //OJO
    Route::inertia('/buscar-locker','User/BuscarLocker')->name('buscar-locker');//LISTO
    Route::get('/solicitud-locker', function () {
        return inertia('User/SolicitudLocker', [
            'lockerData' => request()->all()
        ]);
    })->name('solicitud-locker');
    Route::get('/solicitud-locker', function () {
    return inertia('User/SolicitudLocker', [
        'lockerData' => request()->all()
    ]);
})->name('solicitud-locker');
    Route::inertia('/mis-solicitudes','User/MisSolicitudes')->name('mis-solicitudes'); Route::inertia('/devolucion-locker', 'User/DevolucionLocker')->name('devolucion-locker');
    Route::inertia('/reportes-user','User/ReporteIncidencia')->name('reportes-user');
    Route::inertia('/pago-arancel','User/PagoArancel')->name('pago-arancel');// LISTO
    
    Route::get('/multas/usuario',[MultaController::class,'mis_multas']);


    //Rutas protegidas para el ADMIN

    Route::middleware([IsAdminMiddleware::class])->group(function(){

        //Admin
        Route::inertia('/inicio-admin','Admin/HomeAdmin')->name('home-admin'); 
        Route::inertia('/aranceles-admin','Admin/Aranceles')->name('aranceles-admin'); //LISTO Viene con opcion de editar
        Route::inertia('/asignaciones-admin','Admin/Asignaciones')->name('asignaciones-admin'); //LISTO
        Route::inertia('/estadisticas-lockers','Admin/EstadisticasLockers')->name('estadisticas-admin');
        Route::inertia('/gestion-lockers-admin','Admin/GestionLockers')->name('gestion-admin'); //LISTO Falta Back
        Route::inertia('/incidencias-admin','Admin/Incidencias')->name('incidencias-admin'); //OJO
        Route::inertia('/usuarios-admin','Admin/Usuarios')->name('usuarios-admin');

        Route::inertia('/modificar-locker','Admin/ModificarLocker')->name('modificar-locker');

        //BuscarUsuarioAdmin

        Route::get('/admin/buscar',[BuscarUsuarioController::class,'index']);
        
        Route::get('/admin/buscar/{user:card_code}',[BuscarUsuarioController::class,'mostrar_usuario']);

        Route::get('/admin/multas/{user:card_code}',[MultaController::class,'index']);
        Route::post('/admin/multas',[MultaController::class,'store']);
        Route::delete('/admin/multas/{multa:id}',[MultaController::class,'destroy']);

    });

});


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);

Route::inertia('/forgot-password','Auth/ForgotPassword')->name('forgot-password');
Route::inertia('/verify-code','Auth/VerifyCode')->name('verify-code');
Route::inertia('/new-password','Auth/NewPassword')->name('new-password');

Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);


