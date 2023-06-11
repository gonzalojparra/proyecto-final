<?php

namespace App\Http\Livewire\Competencias;

use App\Http\Middleware\Authenticate;
use App\Models\Categoria;
use App\Models\CompetenciaCompetidor;
use App\Models\Team;
use DragonCode\Contracts\Cashier\Auth\Auth as AuthAuth;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormularioInscripcion extends Component
{
    public $open = false;
    public $nombre;
    public $apellido;
    public $email;
    public $escuela;
    public $escuelaInicial;
    public $graduacionInicial;
    public $du;
    public $graduacion;
    public $idUsuario;
    public $editarGraduacion = 'disable';
    public $editarEscuela = 'disable';
    public $categoria = 1;
    public $poomsae = 1;
    public $idCompetencia = 1;
    public $datosEditados = false;
    public $botonEscuela;
    public $botonGraduacion;
    public $escuelas;
    public $graduaciones = [
        "1 GUP, Rojo borde negro",
        "2 GUP, Rojo",
        "3 GUP, Azul borde rojo",
        "4 GUP, Azul",
        "5 GUP, Verde borde azul",
        "6 GUP, Verde",
        "7 GUP, Amarillo borde verde",
        "8 GUP, Amarillo",
        "9 GUP, Blanco borde amarillo",
        "10 GUP, Blanco",
        "1 DAN, Negro",
        "2 DAN, Negro",
        "3 DAN, Negro",
        "4 DAN, Negro",
        "5 DAN, Negro",
        "6 DAN, Negro",
        "7 DAN, Negro",
        "8 DAN, Negro",
        "9 DAN, Negro"
    ];

    //falta 
    //deshabilitar el select (no me salio)
    //enviar solicitud de edicion al admin
    //si es juez, cargar datos a competencia_juez
    //si es competidor, cargar datos a competencia_competidor
    //enviar solicitud de aprobación de inscripción al admin
    //sortear los poomsaes

    protected $listeners = ['abrirModal' => 'abrirModal'];

    public function render()
    {
        $this->botonEscuela = 'Actualizar';
        $this->botonGraduacion = 'Actualizar';
        $this->escuelas = Team::all()->pluck('name');
        return view('livewire.competencias.formulario-inscripcion');
    }

    public function create()
    {
        if($this->escuelaInicial != $this->escuela || $this->graduacionInicial != $this->graduacion){
            //se envia solicitud de edicion al admin
            dd('edicion');
        }
        // dd($this->idCompetencia);
        $competencia_competidor = new CompetenciaCompetidor();
        $competencia_competidor->id_competencia = $this->idCompetencia;
        $competencia_competidor->id_competidor = $this->idUsuario;
        $competencia_competidor->id_poomsae = $this->poomsae;
        $competencia_competidor->id_categoria = $this->categoria;
        $competencia_competidor->calificacion = null;
        $competencia_competidor->tiempo_presentacion = null;
        $competencia_competidor->inscripto = null;
        $competencia_competidor->save() ? $this->emit('confirmacion', true) : $this->emit('confirmacion', false);
        $this->open = false;
    }

    private function calcularCategoria($fechaNac)
    {
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


    public function abrirModal($idCompetencia)
    {
        $usuario = Auth::user();
        $this->idUsuario = $usuario->id;
        $this->nombre = $usuario->name;
        $this->apellido = $usuario->apellido;
        $this->email = $usuario->email;
        $this->du = $usuario->du;
        $this->escuela = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->graduacion = $usuario->graduacion;
        $this->open = true;
        $this->idCompetencia = $idCompetencia;
        $this->escuelaInicial = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->graduacionInicial = $usuario->graduacion;
    }

    public function editar($input)
    {
        if ($input == 'escuela') {
            if ($this->editarEscuela == 'readonly') {
                $this->editarEscuela = '';
            }
        } else if ($input == 'graduacion') {
            if ($this->editarGraduacion == 'readonly') {
                $this->editarGraduacion = '';
            }
        }
    }
}
