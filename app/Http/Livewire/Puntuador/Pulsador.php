<?php

namespace App\Http\Livewire\Puntuador;

use Livewire\Component;
use App\Models\PasadaJuez;
use App\Models\Pasada;
use App\Events\EnviarPasada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Pulsador extends Component {

    public $pasada = null;
    public $esJuez = false;
    public $tipoPuntaje = 1;
    public $puntaje = 10;
    public $puntajeExactitud;
    public $puntajePresentacion;
    public $alerta = null;

    protected $listeners = ['render' => 'render'];

    public function render() {
        return view('livewire.puntuador.pulsador');
    }


    public function traerPasada()
    {
        $pasada = Pasada::where('tiempo_presentacion', null)->where('seleccionado', 1)->first();
        if ($pasada != null){
            $this->pasada = $pasada;
            $this->verificarJuez();
            $this->emit('render');
        } else{
            $this->alerta = "Aun no se elige un competidor.";
        }
    }

    public function verificarJuez()
    {
        $pasadaJuez = PasadaJuez::where('id_juez', Auth::user()->id)->where('id_pasada', $this->pasada->id)->first();
        if ($pasadaJuez != null){
            if ($pasadaJuez->puntaje_exactitud == null && $pasadaJuez->puntaje_presentacion == null){
                $this->esJuez = true;
            } else {
                $this->alerta = "Ya votaste esta pasada.";
            }
        } else{
            $this->alerta = "No eres juez de esta competencia.";
        }
    }

    public function store() {
        $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)->first();
        if ($pasadaJuez != null){
            $pasadaJuez->puntaje_exactitud = $this->puntajeExactitud;
            $pasadaJuez->puntaje_presentacion = $this->puntajePresentacion;
            $pasadaJuez->save();
            $this->pasada->cant_votos = $this->pasada->cant_votos + 1;
            $this->pasada->save();
            $this->darVotoFinal();
            $this->reset('esJuez');
            $this->alerta = 'Tu voto se envio correctamente';
            $this->emit('render');
        }
    }

    public function darVotoFinal(){
        $jueces = $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)->get()->toArray();
        if (count($jueces) == $this->pasada->cant_votos){
            // Hacemos la logica si son 3 jueces
            if ($cantVotos == 3){
                $suma = 0;
                foreach ($jueces as $juez) {
                    $suma = $suma + $juez->puntaje_exactitud + $juez->puntaje_presentacion;
                }
                $promedio = $suma/3;
                $this->pasada->calificacion = $promedio;
                $this->reset('pasada');
            // Hacemos la logica si son 5 o 7 jueces
            } else{
                $suma = 0;
                $votos = array();
                // Obtenemos todos los votos.
                foreach ($jueces as $juez) {
                    $votos[] = $juez->puntaje_exactitud + $juez->puntaje_presentacion;
                }
                // Obtenemos el voto mas alto.
                $masAlto = max($votos);
                // Obtenemos el voto mas bajo.
                $masBajo = min($votos);
                foreach ($votos as $voto) {
                    if ($voto != $masAlto && $voto != $masBajo){
                        $suma = $suma + $voto;
                    }
                }
                $promedio = $suma/count($jueces);
                $this->pasada->calificacion = $promedio;
                $this->reset('pasada');
            }
        }
    }

    public function resto1() {
        $puntaje = $this->puntaje;
        if ($puntaje > 0.1){
            $this->puntaje = $puntaje - 0.1;
        } else{
            $this->puntaje = 0;
        }
    }

    public function resto3() {
        $puntaje = $this->puntaje;
        if ($puntaje > 0.3){
            $this->puntaje = $puntaje - 0.3;
        } else{
            $this->puntaje = 0;
        }
    }

    public function enviar() {
        $tipoPuntaje = $this->tipoPuntaje;
        if ($tipoPuntaje == 1){
            $this->puntajeExactitud = $this->puntaje;
            $this->puntaje = 10;
            $this->tipoPuntaje = 2;
        } elseif ($tipoPuntaje == 2){
            $this->puntajePresentacion = $this->puntaje;
            $this->puntaje = 10;
            $this->store();
        }
    }

    /**
     * Método para consultar la cantidad de jueces por pasada
     */
    public function cantJueces( $idPasada ){
        $cantJuecesPasada = DB::table('pasada_juez')
            ->where('id_pasada', $idPasada)
            ->count();
        return $cantJuecesPasada;
    }

    public function esperarTimer($idPasada) {
        $estadoTimer = Pasada::where('id', $idPasada)
            ->where('estado_timer', 1)
            ->get()
            ->count();
        return $estadoTimer;
    }

}
