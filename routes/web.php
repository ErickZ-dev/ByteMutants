<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\usuarioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login',            'App\Http\Controllers\usuarioController@login');
Route::get('/registrar',        'App\Http\Controllers\usuarioController@registrar');
Route::get('/logout',           'App\Http\Controllers\usuarioController@logout')            ->name('salir');
Route::get('/inicio',           'App\Http\Controllers\usuarioController@inicio')            ->name('inicio');
Route::get('/arena',            'App\Http\Controllers\usuarioController@arena')             ->name('arena');
Route::get('/tienda/mutantes',  'App\Http\Controllers\usuarioController@tiendaM')           ->name('tiendaM');
Route::get('/configuraciones',  'App\Http\Controllers\usuarioController@configuraciones')   ->name('configuraciones');

Route::post('/registrar',       'App\Http\Controllers\usuarioController@store')             ->name('registrar');
Route::post('/login',           'App\Http\Controllers\usuarioController@session')           ->name('loguear');
Route::post('/comprarMutante',  'App\Http\Controllers\monstruoController@store')            ->name('compMutante');

Route::put('/modificar/{id}',   'App\Http\Controllers\usuarioController@update')            ->name('modificar');
Route::put('/modificarMut/{id}','App\Http\Controllers\monstruoController@update')           ->name('modificarMut');
Route::put('/selecMut/{id}',    'App\Http\Controllers\monstruoController@seleccion')        ->name('selecMut');




Route::get('/prueba',   'App\Http\Controllers\usuarioController@prueba');
Route::get('/p',        'App\Http\Controllers\usuarioController@prueba2');

Route::get('/', function () {
    return redirect('inicio');
});
