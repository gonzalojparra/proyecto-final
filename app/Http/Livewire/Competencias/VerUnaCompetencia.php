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
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VerUnaCompetencia extends Component {
    public $competidor;
    public $request;
    public $usuario;
    public $userCategoria;
    public $nombreEscuela;
    public $escuelaId;
    public $id_competidor;
    public $graduacion;
    public $categoria;
    public $email;
    public $nombre;
    public $apellido;
    public $du;
    public $open = false;
    public $escuelas;
    public $graduaciones;
    public $dato;
    public $competenciaId;
    public $inscripcionAceptada;
    public $formAceptado = false;
    public $bandera = true;

    public $mensaje;
    protected $listeners = ['confirmacion'];

    public function mount($competenciaId) {
        $this->competenciaId = $competenciaId;
    }

    public function render() {
        // $this->procesoIncsripcion();
        $this->procesoInscripcionJuez();
        $this->procesoInscripcionCompetidor();
        $query = Competencia::where('id', $this->competenciaId)->get();
        $data = $query[0]->toArray();
        $data['mostrarBoton'] = $this->mostrarBoton();
        return view('livewire.competencias.ver-una-competencia', [
            'data' => $data
        ]);
       
    }

    public function mostrarDatos($idUsuario) {
        $usuario = User::find($idUsuario);
        $this -> nombre = $usuario -> name;
        $this -> apellido = $usuario -> apellido;
        $this -> email = $usuario -> email;
        $this -> escuelaId = $usuario -> id_escuela;
        $this -> nombreEscuela = Team::find($usuario->id_escuela)->pluck('name');
        $this -> categoria = $this -> calcularCategoria($usuario->fecha_nac);
        $this -> graduacion = $usuario -> graduacion;
        $this -> du = $usuario -> du;
        
        $this -> open = true;
    }

    private function calcularCategoria($fechaNac) {
        $categoria = '';
        $fechaActual = time();
        $fechaNac = strtotime($fechaNac);
        $edad = round(($fechaActual - $fechaNac) / 31563000);
        if ($edad >= 8.0 && $edad <= 11.0) {
            $categoria = 'Infantiles';
        }
        if ($edad >= 12.0 && $edad <= 14.0) {
            $categoria = 'Cadete';
        }
        if ($edad >= 15.0 && $edad <= 17.0) {
            $categoria = 'Juveniles';
        }
        if ($edad >= 18.0 && $edad <= 30.0) {
            $categoria = 'Senior1';
        }
        if ($edad >= 31.0 && $edad <= 50.0) {
            $categoria = 'Senior2-master1';
        }
        if ($edad >= 50.0) {
            $categoria = 'Master2';
        }
        return $categoria;
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