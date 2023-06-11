<?php

namespace App\Http\Livewire\Competencias;
use App\Models\Competidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Competencia;
use App\Models\Categoria;
use App\Models\Team;
use App\Models\CompetenciaCompetidor;
use App\Models\User;
use Livewire\Component;

class VerUnaCompetencia extends Component
{
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

    public function mount($competenciaId){
        $this->competenciaId = $competenciaId;
    }

    public function render() {
        // dd($this->categoriaElegida);
        // $usuarios = User::where('name', 'like', '%' . $this->filtro . '%')
        //     ->orWhere('apellido', 'like', '%' . $this->filtro . '%')
        //     ->get(); // Obtenemos todos los usuarios
        $query = Competencia::where('id', $this->competenciaId)->get();
        $data = $query[0]->toArray();
        return view('livewire.competencias.ver-una-competencia', [
            'data' => $data
        ]);
    }

    public function mostrarDatos($idUsuario){
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

    private function calcularCategoria($fechaNac){
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

    public function inscribir(Request $request, Competidor $competidor) {
        $user = Auth::user();
        $userCategoria = Categoria::find($user->id_categoria);
        $userTeam = Team::find($user->id_escuela);
        $competidor = new CompetenciaCompetidor();
        $competidor->id_competidor = $user->id; // ID del competidor
        $competidor->id_poomsae = 1; // ID del poomsae
        $competidor->calificacion = 0; // Calificación
        $competidor->tiempo_presentacion = 0; // Tiempo de presentación
        $competidor->inscripto = null; // Fecha actual

        $competidor->save();
        dd($competidor);
    }


}
