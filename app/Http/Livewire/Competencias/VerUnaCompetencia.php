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
    public $mensaje;
    protected $listeners = ['confirmacion'];

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

   

    public function mostrarInscripcion($idCompetencia){

        $this->emit('abrirModal', $idCompetencia);
    }

    public function confirmacion($boolean){
            $this -> mensaje = false;
    }

}
