<?php

namespace App\Http\Controllers;

use App\Models\Pasada;

class TimerController extends Controller {

    public function index() {
        $pasadas = Pasada::all();
        $pasadasArray = $pasadas->toArray();
        return view('timer', compact('pasadasArray'));
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

}