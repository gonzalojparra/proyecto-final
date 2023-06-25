<?php

namespace App\Http\Livewire\Puntuador;

use Livewire\Component;
use App\Models\PasadaJuez;
use App\Models\Pasada;
use App\Events\EnviarPasada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetenciaJuez;

class Pulsador extends Component
{

    public $pasada = null;
    public $esJuez = false;
    public $tipoPuntaje = 1;
    public $puntaje = 4;
    public $puntajeExactitud;
    public $puntajePresentacion;
    public $alerta = null;
    public $mostrarModalEspera = false;
    public $totalJueces;
    public $juecesVotaron;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        return view('livewire.puntuador.pulsador');
    }

    public function mount()
    {
        $this->totalJueces = $this->cantJueces();
        $this->juecesVotaron = collect();
        $this->tipoPuntaje = request()->get('tipoPuntaje', 1); // Obtener el valor de $tipoPuntaje de la URL, si no se proporciona, se establecerá en 1 por defecto
    }

    public function traerPasada()
    {
        $pasada = Pasada::where('tiempo_presentacion', null)->where('seleccionado', 1)->first();
        if( $pasada != null ){
            $this->pasada = $pasada;
            $this->verificarJuez();
            $this->emit('render');
        } else {
            $this->alerta = "Aun no se elige un competidor.";
        }
    }

    public function getPasada()
    {
        $pasada = Pasada::where('tiempo_presentacion', null)->where('seleccionado', 1)->first();
        if ($pasada != null) {
            $this->pasada = $pasada;
            echo json_encode(['pasada' => $this->pasada->id]);
        }
    }

    public function verificarJuez()
    {
        $pasadaJuez = PasadaJuez::where('id_juez', Auth::user()->id)->where('id_pasada', $this->pasada->id)->first();
        if( $pasadaJuez != null ){
            if( $pasadaJuez->puntaje_exactitud == null && $pasadaJuez->puntaje_presentacion == null ){
                $this->esJuez = true;
            } else {
                $this->alerta = "Ya votaste esta pasada.";
            }
        } else {
            $this->alerta = "No eres juez de esta competencia.";
        }
    }

    public function store() {
        $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)
            ->where('id_juez', Auth::user()->id)
            ->first();
        if( $pasadaJuez != null ){
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

    public function darVotoFinal() {
        $jueces = PasadaJuez::where('id_pasada', $this->pasada->id)->get()->toArray();
        if( count($jueces) == $this->pasada->cant_votos ){
            // Hacemos la logica si son 3 jueces
            $cantVotos = $this->pasada->cant_votos;
            if( $cantVotos == 3 ){
                $suma = 0;
                foreach( $jueces as $juez ){
                    $suma = $suma + $juez->puntaje_exactitud + $juez->puntaje_presentacion;
                }
                $promedio = $suma / 3;
                $this->pasada->calificacion = $promedio;
                $this->reset( 'pasada' );
            // Hacemos la logica si son 5 o 7 jueces
            } else {
                $suma = 0;
                $votos = array();
                // Obtenemos todos los votos.
                foreach( $jueces as $juez ){
                    $votos[] = $juez->puntaje_exactitud + $juez->puntaje_presentacion;
                }
                // Obtenemos el voto mas alto.
                $masAlto = max( $votos );
                // Obtenemos el voto mas bajo.
                $masBajo = min( $votos );
                foreach( $votos as $voto ){
                    if( $voto != $masAlto && $voto != $masBajo ){
                        $suma = $suma + $voto;
                    }
                }
                $promedio = $suma/count( $jueces );
                $this->pasada->calificacion = $promedio;
                $this->reset( 'pasada' );
            }
        }
    }

    public function resto1()
    {
        $puntaje = $this->puntaje;
        if( $puntaje > 0.1 ){
            $this->puntaje = $puntaje - 0.1;
        } else {
            $this->puntaje = 0;
        }
    }

    public function resto3()
    {
        $puntaje = $this->puntaje;
        if( $puntaje > 0.3 ){
            $this->puntaje = $puntaje - 0.3;
        } else {
            $this->puntaje = 0;
        }
    }

    public function enviar() {
        $bandera['resp'] = false;
        $tipoPuntaje = $this->tipoPuntaje;
        if( $tipoPuntaje == 1 ){ // Exactitud
            $this->puntajeExactitud = $this->puntaje;
            $this->puntaje = 4; // Empieza con 10 o 4?
            $this->tipoPuntaje = 2;
            $bandera['resp'] = true;
        } elseif( $tipoPuntaje == 2 ){ // Presentación
            $this->puntajePresentacion = $this->puntaje;
            $this->puntaje = 6; // Empieza con 10 o 6?
            $this->store();
            $bandera['resp'] = true;
        }
        return $bandera;
    }

    public function votoExactitud()
    {
        $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)
            ->where('id_juez', Auth::user()->id)
            ->first();

        // usaremos el valor 20 simbolicamente para tener solo una referencia de que en el pulsador ya se ha votado por exactitud
        $pasadaJuez->puntaje_exactitud = 20;
        $pasadaJuez->save();
    }

    public function votoPresentacion()
    {
        $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)
            ->where('id_juez', Auth::user()->id)
            ->first();

        // usaremos el valor 20 simbolicamente para tener solo una referencia de que en el pulsador ya se ha votado por presentacion
        $pasadaJuez->puntaje_presentacion = 20;
        $pasadaJuez->save();
    }
    /* public function chequearJuecesVotados(){
        if ($this->juecesVotaron->count() == $this->totalJueces) {
            $this->mostrarModalEspera = false;
            $this->juecesVotaron = null;
        }
    } */

    public function chequearJuecesVotados()
    {
        // Lógica para verificar si todos los jueces han votado
        if ($this->juecesVotaron == null) {
            return response()->json(true); // Todos los jueces han votado
        } elseif ($this->juecesVotaron != null) {
            return response()->json(false); // Al menos un juez no ha votado todavía
        }
    }


    /**
     * Método para consultar la cantidad de jueces por pasada
     */
    public function cantJueces()
    {
        $idCompetencia = 2; // Reemplaza con el valor deseado

        $jueces = CompetenciaJuez::where('id_competencia', $idCompetencia)
            ->join('users', 'users.id', '=', 'competencia_juez.id_juez')
            ->select('users.*')
            ->get();

        $totalJueces = $jueces->count();

        return $totalJueces;
        /* $cantJuecesPasada = DB::table('pasadas_juez')
            ->where('id_pasada', $idPasada)
            ->count();
        $this->totalJueces = $cantJuecesPasada;
        return $cantJuecesPasada; */
    }

    /**
     * Método para consultar si el timer esta activo
     */
    public function esperarTimer( $idPasada ){
        $bandera['resp'] = false;
        $estadoTimer = Pasada::where('id', $idPasada)
            ->where('estado_timer', 1)
            ->get()
            ->toArray();
        //return $estadoTimer;
        //return is_array($estadoTimer);
        if( is_array($estadoTimer) && count($estadoTimer) > 0 ){
            $bandera['resp'] = true;
        }
         //->count();
        return $bandera;
    }

    public function esperarTimerPausao( $idPasada ){
        $bandera['resp'] = false;
        $estadoTimer = Pasada::where('id', $idPasada)
            ->where('estado_timer', 0)
            ->get()
            ->toArray();
        //return $estadoTimer;
        //return is_array($estadoTimer);
        if( is_array($estadoTimer) && count($estadoTimer) > 0 ){
            $bandera['resp'] = true;
        }
         //->count();
        return $bandera;
    }
}
