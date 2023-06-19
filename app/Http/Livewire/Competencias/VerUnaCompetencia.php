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
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VerUnaCompetencia extends Component {
    public $competidor;
    public $request;
    public $open = false;
    public $escuelas;
    public $graduaciones;
    public $dato;
    public $competenciaId;
    public $inscripcionAceptada;
    public $formAceptado = false;
    public $bandera = true;

    public $mostrarResultados = false;
    public $mostrarPoomsaes = false;

    public $mensaje;
    protected $listeners = ['confirmacion'];

    //datos para mostrar los poomsaes correspondientes
    public $idCompetidor;
    public $idPasada1;
    public $idPasada2;

    public function mount($competenciaId) {
        $this->competenciaId = $competenciaId;
    }

    public function render() {
        // $this->procesoIncsripcion();
        $this->procesoInscripcionJuez();
        $this->procesoInscripcionCompetidor();
        $query = Competencia::where('id', $this->competenciaId)->get();
        $data = $query[0]->toArray();
        if($data['estado'] == 5){
            $this->mostrarResultados = true;
        } else if($data['estado'] == 3){
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


    public function mostrarBoton() {
        $queryCompetidor = CompetenciaCompetidor::where('id_competencia', $this->competenciaId)
            ->where('id_competidor', Auth::user()->id);
        if( $queryCompetidor->exists() ){
            $this->bandera = false;
        } else {
            $queryJuez = CompetenciaJuez::where('id_competencia', $this->competenciaId)
                ->where('id_juez', Auth::user()->id);
            if( $queryJuez->exists() ){
                $this->bandera = false;
            }
        }
        return $this->bandera;
    }

    //esto no anda pq no hay nada en la tabla
    public function obtenerPoomsaes(){
        $this -> idCompetidor = CompetenciaCompetidor::where('id_competencia', $this->competenciaId)
        ->where('id_competidor', Auth::user()->id);
        $pasada1 = Pasada::where('id_competidor', $this->idCompetidor)->where('id_competencia', $this->competenciaId)->where('ronda', 1);
        $pasada = $pasada1->toArray();
        dd($pasada);
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

    public function mostrarInscripcion($idCompetencia){
        $this->emit('abrirModal', $idCompetencia);
    }

    public function aceptarForm() {
        $this->formAceptado = true;
    }

    public function procesoInscripcionJuez(){
        $usuario = Auth::user();
      
            $aprobado = CompetenciaJuez::where('id_juez', $usuario->id)
                ->where('id_competencia', $this->competenciaId)
                ->first();
    
            if ($aprobado !== null) {
                if ($aprobado->aprobado == 0) {
                    $this->inscripcionAceptada = false;
                } else {
                    $this->inscripcionAceptada = true;
                }
            } else {
                $this->inscripcionAceptada = false;
            }   
           
    }
    

    public function procesoInscripcionCompetidor(){
        $usuario = Auth::user();
      
            $aprobado = CompetenciaCompetidor::where('id_competidor', $usuario->id)
                ->where('id_competencia', $this->competenciaId)
                ->first();
    
            if ($aprobado !== null) {
                if ($aprobado->aprobado == 0) {
                    $this->inscripcionAceptada = false;
                } else {
                    $this->inscripcionAceptada = true;
                }
            } else {
                $this->inscripcionAceptada = false;
            }   
           
    }


}