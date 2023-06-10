<?php

use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Security;
use Whoops\Run;

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

/*  Route::get('/', function () {
     return view('welcome');
 }); */

/* Route::get('/', function () {
    return view('welcome');
})->name('home'); */

// Navegacion
Route::get('/', function () {
    return view('/index');
})->name('index');

Route::get('/resultados', function () {
    return view('resultados');
})->name('resultados');



// Registro
Route::get('/register', [UserController::class, 'create'])
    ->middleware(['guest'])
    ->name('registrar');

Route::post('/register', [UserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');

Route::get('/inscripcion', [CompetidorController::class, 'inscripcion'])->name('inscripcion');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('permisos', [Security\PermissionController::class, 'index'])->name('permisos.index');
});


// Middleware Admin
Route::group(['middleware' => ['role:Admin']], function() {
    Route::get('roles', [Security\RolesController::class, 'index'])->name('roles.index');
    Route::view('/roles','roles.show')->name('roles');
    Route::view('/timer', 'timer')->name('timer');

});


// Competencias
Route::view('competencias', 'competencias.index')->name('competencias.index');
Route::view('/verCompetidores','competidores.tablaCompetidores')->name('tablaCompetidores');
Route::view('/competencia-id','competencias.verUnaCompetencia')->name('verUnaCompetencia');


// Competidores
Route::resource('competidores', CompetidorController::class);

Route::post('/competidores/inscripcion', [CompetidorController::class, 'inscribir'])->name('competidores.inscripcion');

Route::post('/competidores/actualizar', [CompetidorController::class, 'actualizarEscuela'])->name('competidores.actualizarEscuela');
Route::post('/competidores/actualizarGraduacion', [CompetidorController::class, 'actualizarGraduacion'])->name('competidores.actualizarGraduacion');

Route::post('/competidores/actualizarGraduacion', [CompetidorController::class, 'actualizarGraduacion'])->name('competidores.actualizarGraduacion');

Route::post('/competidores/create', [CompetidorController::class, 'buscarCompetidor'])->name('competidores.buscarCompetidor');

Route::post('/competidores/buscarPaises', [CompetidorController::class, 'buscarPaises'])->name('competidores.buscarPaises');

Route::post('/competidores/buscarColegio', [CompetidorController::class, 'buscarColegio'])->name('competidores.buscarColegio');


Route::post('/obtenerEscuelas',)->name('acciones.obtenerEscuelas');


// Middleware Juez
//Puntuador
Route::group(['middleware' => ['role:Juez']], function() {
    Route::view('/competencias/puntuador','competencias.puntuador')->name('puntuador');
});


// TESTEOS
Route::get('/test.{id}', [UserController::class, 'show']);