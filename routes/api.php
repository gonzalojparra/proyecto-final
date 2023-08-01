<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimerController;
use App\Http\Livewire\Puntuador\Pulsador;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Timer
Route::get('/seleccion/{idPasada}', [TimerController::class, 'seleccion']);
Route::get('/enviarTiempo/{tiempoTotal}.{idPasada}', [TimerController::class, 'enviarTiempo']);
Route::post('/iniciarTimer/{idPasada}', [TimerController::class, 'iniciarTimer']);
Route::get('/pararTimer/{idPasada}', [TimerController::class, 'pararTimer']);
Route::post('/resetearTimer/{idPasada}', [TimerController::class, 'resetearTimer']);
Route::get('/get-pasadas/{competenciaId}/{categoriaId}', [TimerController::class, 'getPasadas']);
Route::get('/get-competidor/{competidorId}', [TimerController::class, 'getCompetidor']);
Route::get('/get-competencia', [TimerController::class, 'getCompetencia']);

Route::get('/get-pasadasjuez/{idPasada}', [TimerController::class, 'getPasadasJuez']);
Route::get('/get-puntajes/{idJuez}/{idPasada}', [TimerController::class, 'getPuntajes']);
Route::get('/get-juezdata/{idJuez}', [TimerController::class, 'getJuezData']);

// Pulsador
Route::get('/getPasada', [Pulsador::class, 'getPasada']);
Route::post('/cantJueces/{idPasada}', [Pulsador::class, 'cantJueces']);
Route::post('/esperarTimer/{idPasada}', [Pulsador::class, 'esperarTimer']);
Route::post('/esperarTimerPausao/{idPasada}', [Pulsador::class, 'esperarTimerPausao']);
Route::post('/enviar/{idPasada}', [Pulsador::class, 'enviar']);