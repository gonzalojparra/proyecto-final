<?php

use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Security;
use App\Http\Livewire\Competencias\Competencias;
use App\Http\Livewire\Competencias\VerCompetencias;
use App\Http\Livewire\Competencias\VerUnaCompetencia;
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

Route::fallback( function () {
    return redirect()->route('index');
});

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
    Route::view('/timer', 'timer')->name('timer');

    // Solicitudes registros
    Route::view('/usuarios-pendientes','solicitudes-registro.show')->name('solicitudes-registro');

    // Competencias
    Route::view('/administrar-competencias', 'competencias.index')->name('competencias.administrar-competencias');
    Route::view('/inscriptos-pendientes/{idCompetencia}', 'competencias.solicitudes-inscriptos')->name('solicitudes-inscriptos');
});


Route::view('/verCompetidores','competidores.tablaCompetidores')->name('tablaCompetidores');

// Ver todas las competencias
Route::get('/competencias', VerCompetencias::class)->name('competencias.index');
// Ver una competencia
Route::get('/competencia/{competenciaId}', VerUnaCompetencia::class)->name('competencias.ver-una-competencia');

/* Route::get('/competencia', function () {
    return view('livewire.competencias.ver-una-competencia');
})->name('competencias.ver-una-competencia'); */

// Competidores
Route::resource('competidores', CompetidorController::class);

Route::post('/competidores/inscripcion', [CompetidorController::class, 'inscribir'])->name('competidores.inscripcion');
Route::post('/competencia-id', [CompetidorController::class, 'inscribir'])->name('competencias.verUnaCompetencia');

Route::post('/competidores/actualizar', [CompetidorController::class, 'actualizarEscuela'])->name('competidores.actualizarEscuela');
Route::post('/competencia-id', [CompetidorController::class, 'actualizarEscuela'])->name('competidores.actualizarEscuela');

Route::post('/competidores/actualizarGraduacion', [CompetidorController::class, 'actualizarGraduacion'])->name('competidores.actualizarGraduacion');
/* Route::post('/competencia-id', [CompetidorController::class, 'actualizarGraduacion'])->name('competidores.actualizarGraduacion'); */

Route::post('/competidores/actualizarGraduacion', [CompetidorController::class, 'actualizarGraduacion'])->name('competidores.actualizarGraduacion');

Route::post('/competidores/create', [CompetidorController::class, 'buscarCompetidor'])->name('competidores.buscarCompetidor');

Route::post('/competidores/buscarPaises', [CompetidorController::class, 'buscarPaises'])->name('competidores.buscarPaises');

Route::post('/competidores/buscarColegio', [CompetidorController::class, 'buscarColegio'])->name('competidores.buscarColegio');


Route::post('/obtenerEscuelas',)->name('acciones.obtenerEscuelas');


// Middleware Juez
//Puntuador
Route::group(['middleware' => ['role:Juez']], function() {
    Route::view('/competencias/puntuador','competencias.puntuador')->name('puntuador');
    Route::view('/pulsador','competencia.pulsador')->name('pulsador');
});

Route::view('/competencias/pantallaEspera','livewire.competencias.pantalla-espera')->name('competencias.pantalla-espera');

// livewire.pantalla-espera
// TESTEOS
// Route::get('/test.{id}', [UserController::class, 'show']);