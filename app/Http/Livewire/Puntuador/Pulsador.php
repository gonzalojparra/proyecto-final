<?php

namespace App\Http\Livewire\Puntuador;

use Livewire\Component;
use App\Models\PasadaJuez;
use App\Models\Pasada;
use App\Events\EnviarPasada;
use App\Models\CompetenciaCompetidor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Pulsador extends Component
{

    public $pasada = null;
    public $esJuez = false;
    public $tipoPuntaje = 1;
    public $puntajeExactitudInicial = 4;
    public $puntajePresentacionInicial = 6;
    public $puntajeExactitud;
    public $puntajePresentacion;
    public $alerta = null;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        return view('livewire.puntuador.pulsador');
    }

    public function traerPasada()
    {
        $pasada = Pasada::where('tiempo_presentacion', null)->where('seleccionado', 1)->first();
        if ($pasada != null) {
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
        if ($pasadaJuez != null) {
            if ($pasadaJuez->puntaje_exactitud == null && $pasadaJuez->puntaje_presentacion == null) {
                $this->esJuez = true;
            } else {
                $this->alerta = "Ya votaste esta pasada.";
            }
        } else {
            $this->alerta = "No eres juez de esta competencia.";
        }
    }

    public function store()
    {
        $pasadaJuez = PasadaJuez::where('id_pasada', $this->pasada->id)
            ->where('id_juez', Auth::user()->id)
            ->first();
        if ($pasadaJuez != null) {
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

    public function darVotoFinal()
    {
        $jueces = PasadaJuez::where('id_pasada', $this->pasada->id)
            ->get()
            ->toArray();
        if (count($jueces) == $this->pasada->cant_votos) {
            // Hacemos la logica si son 3 jueces
            $cantVotos = $this->pasada->cant_votos;
            if ($cantVotos == 3) {
                $suma = 0;
                foreach ($jueces as $juez) {
                    $suma = $suma + $juez['puntaje_exactitud'] + $juez['puntaje_presentacion'];
                }
                $promedio = $suma / 3;
                if ($this->pasada->tiempo_presentacion > 90) {
                    $promedio = $promedio - 0.3;
                }
                $this->pasada->calificacion = $promedio;
                $this->pasada->save();
                $this->verificarPasadas($this->pasada->id);
                $this->reset('pasada');
            } else {
                // Hacemos la logica si son 5 o 7 jueces
                $suma = 0;
                $votos = array();
                // Obtenemos todos los votos.
                foreach ($jueces as $juez) {
                    $votos[] = $juez['puntaje_exactitud'] + $juez['puntaje_presentacion'];
                }
                // Obtenemos el voto mas alto.
                $masAlto = max($votos);
                // Obtenemos el voto mas bajo.
                $masBajo = min($votos);
                foreach ($votos as $voto) {
                    if ($voto != $masAlto && $voto != $masBajo) {
                        $suma = $suma + $voto;
                    }
                }
                $promedio = $suma / (count($jueces) - 2);
                //return dd( $promedio);
                if ($this->pasada->tiempo_presentacion > 90) {
                    $promedio = $promedio - 0.3;
                }
                $this->pasada->calificacion = $promedio;
                $this->pasada->save();
                $this->verificarPasadas($this->pasada->id);
                $this->reset('pasada');
            }
            
        }
    }

    public function resto1()
    {
        $puntajeExactitud = $this->puntajeExactitudInicial;
        $puntajePresentacion = $this->puntajePresentacionInicial;

        if ($this->tipoPuntaje == 1) {
            if ($puntajeExactitud > 0.1) {
                $this->puntajeExactitudInicial = $puntajeExactitud - 0.1;
            } else {
                $this->puntajeExactitudInicial = 0;
            }
        } else {
            if ($puntajePresentacion > 0.1) {
                $this->puntajePresentacionInicial = $puntajePresentacion - 0.1;
            } else {
                $this->puntajePresentacionInicial = 0;
            }
        }
    }

    public function resto3()
    {
        $puntajeExactitud = $this->puntajeExactitudInicial;
        $puntajePresentacion = $this->puntajePresentacionInicial;

        if ($this->tipoPuntaje == 1) {
            if ($puntajeExactitud > 0.3) {
                $this->puntajeExactitudInicial = $puntajeExactitud - 0.3;
            } else {
                $this->puntajeExactitudInicial = 0;
            }
        } else {
            if ($puntajePresentacion > 0.3) {
                $this->puntajePresentacionInicial = $puntajePresentacion - 0.3;
            } else {
                $this->puntajePresentacionInicial = 0;
            }
        }
    }

    public function enviar()
    {
        $bandera['resp'] = false;
        $tipoPuntaje = $this->tipoPuntaje;
        if ($tipoPuntaje == 1) { // Exactitud
            $this->puntajeExactitud = $this->puntajeExactitudInicial;
            $this->puntajeExactitudInicial = 4;
            $this->tipoPuntaje = 2;
            $bandera['resp'] = true;
        } elseif ($tipoPuntaje == 2) { // Presentación
            $this->puntajePresentacion = $this->puntajePresentacionInicial;
            $this->puntajePresentacionInicial = 6;
            $this->store();
            $bandera['resp'] = true;
        }
        return $bandera;
    }

    /**
     * Método para consultar la cantidad de jueces por pasada
     */
    public function cantJueces($idPasada)
    {
        $cantJuecesPasada = DB::table('pasadas_juez')
            ->where('id_pasada', $idPasada)
            ->count();
        return $cantJuecesPasada;
    }

    /**
     * Método para consultar si el timer esta activo
     */
    public function esperarTimer($idPasada)
    {
        $bandera['resp'] = false;
        $estadoTimer = Pasada::where('id', $idPasada)
            ->where('estado_timer', 1)
            ->get()
            ->toArray();
        if (is_array($estadoTimer) && count($estadoTimer) > 0) {
            $bandera['resp'] = true;
        }
        return $bandera;
    }

    public function esperarTimerPausao($idPasada)
    {
        $bandera['resp'] = false;
        $estadoTimer = Pasada::where('id', $idPasada)
            ->where('estado_timer', 0)
            ->get()
            ->toArray();
        if (is_array($estadoTimer) && count($estadoTimer) > 0) {
            $bandera['resp'] = true;
        }
        return $bandera;
    }

    private function verificarPasadas($id_pasada)
    {

        $pasada = Pasada::where('id',$id_pasada)->get();
        
        $pasadas = Pasada::where('id_competencia',$pasada[0]->id_competencia)->where('id_competidor',$pasada[0]->id_competidor)->where('calificacion','!=',null)->get();
       
        if (count($pasadas) == 2) {
            $total = 0;
            $competencia_competidor = CompetenciaCompetidor::where('id_competencia', '=', $pasada[0]->id_competencia)->where('id_competidor', '=', $pasada[0]->id_competidor)->first();
            foreach ($pasadas as $tupla) {
                $total += $tupla->calificacion;
            }
            
            $competencia_competidor->calificacion = $total;
            $competencia_competidor->save();
        }
    }
}
