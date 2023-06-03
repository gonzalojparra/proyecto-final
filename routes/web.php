<?php

use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Security;

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


Route::get('/inscripcion', [CompetidorController::class, 'inscripcion'])->name('inscripcion');

Route::view('/roles/show','roles.show')->name('roles');

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
    Route::view('/roles/show','roles.show')->name('roles');
});

// Registro
Route::get('/register', [UserController::class, 'create'])
    ->middleware(['guest'])
    ->name('registrar');

Route::post('/register', [UserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');

// Competidores
Route::resource('competidores', CompetidorController::class);

Route::post('/competidores/inscripcion', [CompetidorController::class, 'inscribir'])->name('competidores.inscripcion');

Route::post('/competidores/create', [CompetidorController::class, 'buscarCompetidor'])->name('competidores.buscarCompetidor');

Route::post('/competidores/buscarPaises', [CompetidorController::class, 'buscarPaises'])->name('competidores.buscarPaises');

Route::post('/competidores/buscarColegio', [CompetidorController::class, 'buscarColegio'])->name('competidores.buscarColegio');

Route::post('/obtenerEscuelas',)->name('acciones.obtenerEscuelas');

//Puntuador
Route::view('/competencia/puntuador','competencia.puntuador')->name('puntuador');

// TESTEOS
Route::get('/test/{user}.{estado}', [UserController::class, 'verificarUsuario']);
