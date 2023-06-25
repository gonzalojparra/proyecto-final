<?php

namespace App\Http\Livewire\Competencias;

use App\Http\Middleware\Authenticate;
use App\Mail\EnvioMail;
use App\Models\Actualizacion;
use App\Models\Categoria;
use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Graduacion;
use App\Models\PoomsaeCompetenciaCategoria;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FormularioInscripcion extends Component
{
    //variables para abrir el modal
    public $open = false;
    //protected $listeners = ['abrirModal' => 'abrirModal'];

    //datos del usuario
    public $usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $fechaNac;
    public $escuela;
    public $escuelaInicial;
    public $graduacion;
    public $idGraduacion;
    public $graduacionInicial;
    public $idGraduacionInicial;
    public $du;
    public $gal;
    public $galInicial;
    public $idUsuario;
    public $categoria;
    public $idCategoria;
    public $idCompetencia;

    public $categoriaValida = false;

    //variables para manejar el input del gal
    public $editarGal = 'readonly';
    public $inputGal = false;
    public $galRequerido = false;
    public $botonGal;
    protected $rules;

    //variable bandera para enviar un pedido de actualizacion o no
    public $datosEditados = false;

    //listas
    public $categorias;
    public $escuelas;
    public $graduacionesCompetidor;
    //probar el to_array aca para traer esto de la db y que sea mas prolijo :)
    public $graduaciones = [
        "10 GUP, Blanco",
        "9 GUP, Blanco borde amarillo",
        "8 GUP, Amarillo",
        "7 GUP, Amarillo borde verde",
        "6 GUP, Verde",
        "5 GUP, Verde borde azul",
        "4 GUP, Azul",
        "3 GUP, Azul borde rojo",
        "2 GUP, Rojo",
        "1 GUP, Rojo borde negro",
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
    public $poomsaes;
    protected $listeners = ['abrirModal' => 'abrirModal', 'aceptado' => 'render'];

    public function mount($competenciaId)
    {
        $this->idCompetencia = $competenciaId;
    }

    public function render()
    {
        $this->usuario = Auth::user();
        $this->idGraduacionInicial = $this->usuario->id_graduacion;
        $this->graduacionInicial = Graduacion::where('id', $this->idGraduacionInicial)->pluck('nombre');
        if ($this->usuario->id_graduacion != null) {
            $this->graduacionesDisponibles();
        }
        if ($this->graduacion == "1 DAN, Negro") {
            $this->inputGal = true;
        }
        $this->categorias = Categoria::All();
        $this->botonGal = 'Actualizar';
        $this->escuelas = Team::all();
        return view('livewire.competencias.formulario-inscripcion');
    }

    public function graduacionesDisponibles()
    {
        $idGraduacion = array_search($this->graduacionInicial[0], $this->graduaciones);
        $this->graduacionesCompetidor = array_slice($this->graduaciones, $idGraduacion, null, true);
    }


    public function abrirModal($idCompetencia)
    {
        $usuario = Auth::user();
        $this->idUsuario = $usuario->id;
        $this->nombre = $usuario->name;
        $this->apellido = $usuario->apellido;
        $this->email = $usuario->email;
        $this->fechaNac = $usuario->fecha_nac;
        $this->du = $usuario->du;
        $this->escuela = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->idGraduacion = $usuario->id_graduacion;
        $this->graduacion = Graduacion::where('id', $this->idGraduacion)->pluck('nombre');
        $this->gal = $this->usuario->gal;
        $this->galInicial = $this->usuario->gal;
        $this->open = true;
        $this->idCompetencia = $idCompetencia;
        $this->escuelaInicial = Team::where('id', $this->usuario->id_escuela)->pluck('name');
    }

    public function create()
    {
        if (isset($this->idGraduacion)) {
            $this->crearCompetidor();
        } else {
            $this->crearJuez();
        }
        $this->open = false;
    }

    public function submit()
    {
        if ($this->graduacion == "1 DAN, Negro") {
            $this->rules = [
                'gal' => 'required|regex:/^[A-Za-z]{3}\d{7}$/'
            ];
            $this->validate($this->rules);
        }


        $this->create();
    }

    public function crearCompetidor()
    {
        $creado = false;
        $this->calcularCategoria();
        $this->compararDatos();
        // $this->sortPoomsae($this->graduacion);
       if($this->categoriaValida){
        $competencia_competidor = new CompetenciaCompetidor();
        $competencia_competidor->id_competencia = $this->idCompetencia;
        $competencia_competidor->id_competidor = $this->idUsuario;
        $competencia_competidor->id_categoria = $this->idCategoria;
        $competencia_competidor->calificacion = null;
        $competencia_competidor->aprobado = 0;
        $competencia_competidor->save();
       } else {
        //aca habria que tirar un mensaje de error
       }
    }


    public function revisarSiUserEsta()
    {
        $user = Auth::user();
        $esta = false;
        // Busqueda en la bd el rol del user
        $resultados = DB::select('SELECT * FROM model_has_roles WHERE model_id = ?', [$user->id]);
        if (!empty($resultados)) {
            $rol = $resultados[0]->role_id;
            if ($rol == 3) {
                $competencia_competidor = new CompetenciaCompetidor();
                $encontrado = $competencia_competidor->where('id_competidor', $user->id)
                    ->where('id_competencia', '=', $this->idCompetencia)
                    ->first();
                if ($encontrado != null) {
                    $esta = true;
                }
            } elseif ($rol == 2) {
                $competencia_juez = new CompetenciaJuez();
                $encontrado = $competencia_juez->where('id_juez', $user->id)
                    ->where('id_competencia', '=', $this->idCompetencia)
                    ->first();
                if ($encontrado != null) {
                    $esta = true;
                }
            }
        }

        return $esta;
    }


    //hay que modificar la bd, inscripto es un timestamp, y no se puede mandar nulo, debería ser "aceptado" como en competencia_competidor
    public function crearJuez()
    {
        /* $esta = $this->revisarSiUserEsta(); */
        $this->compararDatos();
        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->id_competencia = $this->idCompetencia;
        $competencia_juez->id_juez = $this->idUsuario;
        $competencia_juez->aprobado = false;
        if ($competencia_juez->save()) {
        }
    }
    // ? $this->emit('confirmacion', true) : $this->emit('confirmacion', false)


    public function compararDatos()
    {

        $actualizacion = new Actualizacion();
        $idEscuela =  Team::where('name', $this->escuela)->pluck('id');
        $actualizar = false;
        $actualizacion->id_user = $this->idUsuario;
        if ($this->escuelaInicial != $this->escuela) {
            $actualizacion->id_escuela_nueva = $idEscuela[0];
            if ($this->graduacionInicial != $this->graduacion) {
                $actualizacion->id_graduacion_nueva = $this->idGraduacion;
                if ($this->galInicial != $this->gal) {
                    $actualizacion->gal_nuevo = $this->gal;
                } else {
                    $actualizacion->gal_nuevo = NULL;
                }
            } else {
                if ($this->galInicial != $this->gal) {
                    $actualizacion->gal_nuevo = $this->gal;
                } else {
                    $actualizacion->gal_nuevo = NULL;
                }
                $actualizacion->id_graduacion_nueva = null;
            }
            $actualizar = true;
        } else  if ($this->graduacionInicial != $this->graduacion) {
            if ($this->galInicial != $this->gal) {
                $actualizacion->gal_nuevo = $this->gal;
            } else {
                $actualizacion->gal_nuevo = NULL;
            }
            $actualizacion->id_escuela_nueva = null;
            $actualizacion->id_graduacion_nueva = $this->idGraduacion;
            $actualizar = true;
        } else {
            if ($this->galInicial != $this->gal) {
                $actualizacion->id_escuela_nueva = null;
                $actualizacion->id_graduacion_nueva = null;
                $actualizacion->gal_nuevo = $this->gal;
                $actualizar = true;
            }
        }

        if ($actualizar) {
            $actualizacion->save();
        }
    }


    public function editar()
    {
        $graduacionRequerida = $this->graduaciones[10];
        if ($this->graduacionInicial != $graduacionRequerida && $this->graduacion == $graduacionRequerida || $this->galInicial == null) {
            if ($this->editarGal == 'readonly') {
                $this->editarGal = '';
            } else {
                $this->editarGal = 'readonly';
            }
            if ($this->galRequerido == false) {
                $this->galRequerido = true;
            }
        }
    }

    //para verCompetencias habria que pasar por parametro un $idCompetencia y que ya no se use el $this->idCompetencia
    //esto aplica unicamente al competidor
    private function calcularCategoria()
    {
        $categoriasPermitidas = CompetenciaCategoria::where('id_competencia', $this->idCompetencia)->get();
        $fechaActual = time();
        $fechaNac = strtotime($this->fechaNac);
        $edad = round(($fechaActual - $fechaNac) / 31563000);
        if ($edad >= 12.0 && $edad <= 14.0) {
            $this->idCategoria = 1;
        }
        if ($edad >= 15.0 && $edad <= 17.0) {
            $this->idCategoria = 2;
        }
        if ($edad >= 18.0 && $edad <= 30.0) {
            $this->idCategoria = 3;
        }
        if ($edad >= 31.0 && $edad <= 50.0) {
            $this->idCategoria = 4;
        }
        if ($edad >= 50.0) {
            $this->idCategoria = 5;
        }

        foreach ($categoriasPermitidas as $categoria) {
            if($categoria->id_categoria == $this->idCategoria){
                $this->categoriaValida = true;
            }
        }
        //en lugar de ser un $this->categoriaValida, deberia ser un return true o false
    }

}
