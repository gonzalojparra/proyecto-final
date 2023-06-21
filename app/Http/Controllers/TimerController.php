<?php

namespace App\Http\Controllers;

use App\Models\Pasada;
use App\Events\EnviarPasada;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class TimerController extends Controller {


    public function index(Request $request) {
        $pasadas = Pasada::where('id_competencia', $request->idCompetencia)->where('tiempo_presentacion', null)->get();
        return view('timer', compact('pasadas'));
    }

    public function iniciarTimer($idPasada) {
        $bandera = false;
        if( $idPasada != null ){
            Pasada::where('id', $idPasada)->update(['estado_timer' => 1]);
            $bandera = true;
        }
        return $bandera;
    }

    public function pararTimer($idPasada) {
        $bandera = false;
        if( $idPasada != null ){
            Pasada::where('id', $idPasada)->update(['estado_timer' => 0]);
            $bandera = true;
        }
        return $bandera;
    }

    public function resetearTimer($idPasada) {
        $bandera = false;
        if( $idPasada != null ){
            Pasada::where('id', $idPasada)->update(['estado_timer' => 0, 'tiempo_presentacion' => 0]);
            $bandera = true;
        }
        return $bandera;
    }

    public function seleccion($idPasada) {
        $bandera = false;
        if( $idPasada != null ){
            Pasada::where('id', '!=', $idPasada)->update(['seleccionado' => 0]);
            Pasada::where('id', $idPasada)->update(['seleccionado' => 1]);
            $bandera = true;
        }
        return $bandera;
    }

    public function enviarTiempo($tiempo, $idPasada) {
        $actualizo = false;
        $pasada = Pasada::find($idPasada);
        if ($pasada->exists()){
            $pasada->tiempo_presentacion = $tiempo;
            $pasada->save();
            $actualizo = true;
        }
        return $actualizo;
    }

}