<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Competencia;
use App\Models\Categoria;
use App\Models\Team;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Pasada;
use App\Models\Poomsae;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VerUnaCompetencia extends Component
{
    public $competidor;
    public $request;
    public $open = false;
    public $escuelas;
    public $graduaciones;
    public $dato;
    public $competenciaId;
    public $inscripcionAceptada;
    public $inscripcionAceptadaJuez = null;
    public $inscripcionAceptadaCompe = null;
    public $formAceptado = false;
    public $bandera = true;
    public $cantJuecesCompetencia = 3;

    public $mostrarResultados = false;
    public $mostrarPoomsaes = false;

    public $mensaje;
    protected $listeners = ['confirmacion'];

    //datos para mostrar los poomsaes correspondientes
    public $idCompetidor;
    public $pasada1;
    public $pasada2;


    //variable bandera para comprobar si un competidor o juez está inscripto (no está en uso pq me tira error la función)
    public $existeInscripcion;


    public function mount($competenciaId)
    {
        $this->competenciaId = $competenciaId;
    }

    public function render()
    {
        // $this->revisarSiInscripcionExiste();
        $this->obtenerPoomsaes();

        $this->procesoInscripcionJuez();
        $this->procesoInscripcionCompetidor();
        // $this->cantJuecesCompetencia();

        $query = Competencia::where('id', $this->competenciaId)->get();
        $data = $query[0]->toArray();
        if ($data['estado'] == 5) {
            $this->mostrarResultados = true;
        } else if ($data['estado'] == 3) {
            $this->mostrarPoomsaes = true;
        } else {
            $this->mostrarResultados = false;
            $this->mostrarPoomsaes = false;
        }
        $data['mostrarBoton'] = $this->mostrarBoton();
        return view('livewire.competencias.ver-una-competencia', [
            'data' => $data
        ]);
    }


    public function mostrarBoton()
    {
        $queryCompetidor = CompetenciaCompetidor::where('id_competencia', $this->competenciaId)
            ->where('id_competidor', Auth::user()->id);
        if ($queryCompetidor->exists()) {
            $this->bandera = false;
        } else {
            $queryJuez = CompetenciaJuez::where('id_competencia', $this->competenciaId)
                ->where('id_juez', Auth::user()->id);
            if ($queryJuez->exists()) {
                $this->bandera = false;
            }
        }
        return $this->bandera;
    }

    //esto no anda pq no hay nada en la tabla
    public function obtenerPoomsaes()
    {
        $idCompetencia = Competencia::where('id', $this->competenciaId)->pluck('id');
        $this->idCompetidor = CompetenciaCompetidor::where('id_competencia', $this->competenciaId)
            ->where('id_competidor', Auth::user()->id)->pluck('id_competidor')->toArray();
        if (count($this->idCompetidor) > 0) {
            $this->pasada1 = Pasada::where('id_competidor', $this->idCompetidor[0])->where('id_competencia', $idCompetencia)->where('ronda', 1)->first();
            $this->pasada2 = Pasada::where('id_competidor', $this->idCompetidor[0])->where('id_competencia', $idCompetencia)->where('ronda', 2)->first();
        }
    }

    public function revisarSiInscripcionExiste()
    {
        // $user = Auth::user();
        // $this->existeInscripcion = false;
        // // Busqueda en la bd el rol del user
        // $resultados = DB::select('SELECT * FROM model_has_roles WHERE model_id = ?', [$user->id]);
        // if (!empty($resultados)) {
        //     $rol = $resultados[0]->role_id;
        //     if ($rol == 3) {
        //         $competencia_competidor = new CompetenciaCompetidor();
        //         $encontrado = $competencia_competidor->where('id_competidor', $user->id)
        //             ->where('id_competencia', '=', $this->idCompetencia)
        //             ->first();
        //         if ($encontrado != null) {
        //             $this->existeInscripcion = true;
        //         }
        //     } elseif ($rol == 2) {
        //         $competencia_juez = new CompetenciaJuez();
        //         $encontrado = $competencia_juez->where('id_juez', $user->id)
        //             ->where('id_competencia', '=', $this->idCompetencia)
        //             ->first();
        //         if ($encontrado != null) {
        //             $this->existeInscripcion = true;
        //         }
        //     } else {
        //         $this->existeInscripcion = false;
        //     }
        // }
        $usuarioId = Auth::user()->id;
        $tablaCompetenciaCompetidor = CompetenciaCompetidor::All()->pluck('id_competidor');
        $existeInscripcion = $tablaCompetenciaCompetidor->where('id_competidor', $usuarioId);
        dd($existeInscripcion);
    }

    /* public function mostrarBotonJuez() {
        $bandera = true;
        $query = DB::table('competencia_juez')
            ->where('id_competencia', $this->competenciaId)
            ->where('id_juez', Auth::user()->id)
            ->first();
        if ($query == null) {
            $bandera = false;
        }
        return $bandera;
    } */

    // public function inscribir(Request $request, Competidor $competidor) {
    //     $user = Auth::user();
    //     $userCategoria = Categoria::find($user->id_categoria);
    //     $userTeam = Team::find($user->id_escuela);
    //     $competidor = new CompetenciaCompetidor();
    //     $competidor->id_competidor = $user->id; // ID del competidor
    //     $competidor->id_poomsae = 1; // ID del poomsae
    //     $competidor->calificacion = 0; // Calificación
    //     $competidor->tiempo_presentacion = 0; // Tiempo de presentación
    //     $competidor->inscripto = null; // Fecha actual

    //     $competidor->save();
    //     dd($competidor);
    // }

    public function mostrarInscripcion($idCompetencia)
    {
        $this->emit('abrirModal', $idCompetencia);
    }

    public function aceptarForm()
    {
        $this->formAceptado = true;
    }

    public function procesoInscripcionJuez()
    {
        $usuario = Auth::user();

        $aprobado = CompetenciaJuez::where('id_juez', $usuario->id)
            ->where('id_competencia', $this->competenciaId)
            ->first();

        if ($aprobado !== null) {
            if ($aprobado->aprobado == 0) {
                $this->inscripcionAceptadaJuez = 0;
            }
            if ($aprobado->aprobado == 1) {
                $this->inscripcionAceptadaJuez = 1;
            }
            if ($aprobado->aprobado == 2) {
                $this->inscripcionAceptadaJuez = 2;
            }
        } else {
            $this->inscripcionAceptadaJuez = false;
        }
    }


    public function procesoInscripcionCompetidor()
    {
        $usuario = Auth::user();

        $aprobado = CompetenciaCompetidor::where('id_competidor', $usuario->id)
            ->where('id_competencia', $this->competenciaId)
            ->first();

        if ($aprobado !== null) {
            if ($aprobado->aprobado == 0) {
                $this->inscripcionAceptadaCompe = 0;
            }
            if ($aprobado->aprobado == 1) {
                $this->inscripcionAceptadaCompe = 1;
            }
            if ($aprobado->aprobado == 2) {
                $this->inscripcionAceptadaCompe = 2;
            }
        } else {
            $this->inscripcionAceptadaCompe = false;
        }
    }


    public function cantJuecesCompetencia()
    {
        $competencia = Competencia::find($this->competenciaId); 
        $this->cantJuecesCompetencia = 0; //inicia el contador en 0 
        if ($competencia != null) {
            $inscriptosJuez = CompetenciaJuez::where('id_competencia', $this->competenciaId) //si coinciden los id de la competencia con la competencia que se elijio
                ->where('aprobado', 1) //y el aprobado del competencia_juez es 1 
                ->get(); //se obtiene el juez 

            $this->cantJuecesCompetencia = $inscriptosJuez->count();//se cuenta la cantidad de jueces aprobados y se asigna a la variable publica cantJuecesCompetencia
        }
    }
}
