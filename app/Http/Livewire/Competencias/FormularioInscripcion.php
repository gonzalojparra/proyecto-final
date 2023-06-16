<?php

namespace App\Http\Livewire\Competencias;

use App\Http\Middleware\Authenticate;
use App\Mail\EnvioMail;
use App\Models\Actualizacion;
use App\Models\Categoria;
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

class FormularioInscripcion extends Component {
    public $open = false;
    public $nombre;
    public $apellido;
    public $email;
    public $fechaNac;
    public $escuela;
    public $escuelaInicial;
    public $graduacion;
    public $graduacionInicial;
    public $du;
    public $gal;
    public $idUsuario;
    public $editarGal = 'readonly';
    public $categoria;
    public $idCategoria;
    public $categorias;
    public $poomsae = 1;
    public $idCompetencia;
    public $datosEditados = false;
    public $botonEscuela;
    public $botonGraduacion;
    public $escuelas;
    public $graduacionesCompetidor;
    public $galInicial;
    public $botonGal;
    public $inputGal;
    protected $rules;
    public $galRequerido = false;
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
    protected $listeners = ['abrirModal' => 'abrirModal'];

    public function mount($competenciaId) {
        $this->idCompetencia = $competenciaId;
    }

    public function render() {
        $this->graduacionesDisponibles();
        $this->categorias = Categoria::All();
        $this->botonEscuela = 'Actualizar';
        $this->botonGraduacion = 'Actualizar';
        $this->botonGal = 'Actualizar';
        $this->escuelas = Team::all();
        return view('livewire.competencias.formulario-inscripcion');
    }

    public function graduacionesDisponibles() {
        $idGraduacion = array_search($this->graduacionInicial, $this->graduaciones);
        $this->graduacionesCompetidor = array_slice($this->graduaciones, $idGraduacion, null, true);
    }


    public function abrirModal($idCompetencia) {
        $usuario = Auth::user();
        $this->idUsuario = $usuario->id;
        $this->nombre = $usuario->name;
        $this->apellido = $usuario->apellido;
        $this->email = $usuario->email;
        $this->fechaNac = $usuario->fecha_nac;
        $this->du = $usuario->du;
        $this->escuela = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->graduacion = $usuario->graduacion;
        $this->gal = $usuario->gal;
        $this->galInicial = $usuario->gal;
        $this->open = true;
        $this->idCompetencia = $idCompetencia;
        $this->escuelaInicial = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->graduacionInicial = $usuario->graduacion;
    }

    public function create() {

        if ($this->graduacion != NULL) {
            $this->crearCompetidor();
        } else {
            $this->crearJuez();
        }
        $this->open = false;
    }

    public function submit() {
        if($this->graduacion == "1 DAN, Negro"){
            $this -> rules = [
                'gal' =>'required|regex:/^[A-Za-z]{3}\d{7}$/'
            ];
            $this->validate($this->rules);
        }
       
        $this->create();
    }

    public function crearCompetidor() {
        $creado = false;
        $this->calcularCategoria();
        $this->compararDatos();
        $esta = $this->revisarSiUserEsta();
        if (!$esta) {
            // $this->sortPoomsae($this->graduacion);
            $competencia_competidor = new CompetenciaCompetidor();
            $competencia_competidor->id_competencia = $this->idCompetencia;
            $competencia_competidor->id_competidor = $this->idUsuario;
            $competencia_competidor->id_categoria = $this->idCategoria;
            $competencia_competidor->calificacion = null;
            $competencia_competidor->aprobado = false;
            $competencia_competidor->save();
            Mail::to($this->email)->send(new EnvioMail('aceptado'));
            $creado = true;
            session()->flash('success', '¡Inscripción exitosa!');
        } else {
            session()->flash('error', '¡Ya estás inscrito en esta competencia!');
        }
        return $creado;
    }


    public function revisarSiUserEsta() {
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
    public function crearJuez() {
        $esta = $this->revisarSiUserEsta();
        $this->compararDatos();
        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->id_competencia = $this->idCompetencia;
        $competencia_juez->id_juez = $this->idUsuario;
        $competencia_juez->aprobado = false;
        $competencia_juez->save();
        Mail::to($this->email)->send(new EnvioMail('aceptado'));
    }
    // ? $this->emit('confirmacion', true) : $this->emit('confirmacion', false)


    public function compararDatos() {
        $actualizacion = new Actualizacion();
        $actualizar = false;
        $actualizacion->id_user = $this->idUsuario;
        if ($this->escuelaInicial != $this->escuela) {
            $idEscuela =  Team::where('name', $this->escuela)->pluck('id');
            $actualizacion->id_escuela_nueva = $idEscuela[0];
            if ($this->graduacionInicial != $this->graduacion) {
                $actualizacion->graduacion_nueva = $this->graduacion;
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
                $actualizacion->graduacion_nueva = '-';
            }
            $actualizar = true;
        } else  if ($this->graduacionInicial != $this->graduacion) {
            if ($this->galInicial != $this->gal) {
                $actualizacion->gal_nuevo = $this->gal;
            } else {
                $actualizacion->gal_nuevo = NULL;
            }
            $actualizacion->id_escuela_nueva = 0;
            $actualizacion->graduacion_nueva = $this->graduacion;
            $actualizar = true;
        } else {
            if ($this->galInicial != $this->gal) {
                $actualizacion->id_escuela_nueva = 0;
                $actualizacion->graduacion_nueva = '-';
                $actualizacion->gal_nuevo = $this->gal;
                $actualizar = true;
            }
        }

        if ($actualizar) {
            $actualizacion->save();
        }
    }


    public function editar() {
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

    private function calcularCategoria() {
        $categoria = '';
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

    }




    //poomsaes
    //gup 10 -> IL
    //gup 9 - 7 -> IL - SAM
    //gup 6 - 4 -> I - YOUK
    //gup 3 - 1 -> SAM - PAL
    //dan cadete -> SA - KEUMGANG (4 - 10)
    //dan juvenil -> SA - TAEBACK (4 - 11)
    //dan senior 1 -> SA - PYONKWONG (4 - 12)
    //dan senior2-master1 -> SA - SIPJIN (4 - 13)
    //dan master 2 -> SA - HANSU (4 - 16)

    //ESTA FUNCION PERTENECE A APROBAR INSCRIPCION
    public function asignarPoomsae() {
        //$this->idCategoria y $this->idCompetencia son de formularioInscripción, los van a tener que sacar del objeto traido de competencia_competidor
        $poomsaesCompetidor = [];
        $competenciaCategoria = CompetenciaCategoria::where('id_competencia', $this->idCompetencia)->where('id_categoria', $this->idCategoria)->pluck('id');
        $idGraduacion = Graduacion::where('nombre', $this->graduacion)->pluck('id');
        $poomsaesCompetidor['ronda1'] = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competenciaCategoria[0])->where('id_graduacion', $idGraduacion)->pluck('id_poomsae1')[0];
        $poomsaesCompetidor['ronda2'] = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competenciaCategoria[0])->where('id_graduacion', $idGraduacion)->pluck('id_poomsae2')[0];
        //van a tener que crear un modelo de Pasada para poder cargar
        //$pasadaCompetidor1 y $pasadaCompetidor2 con los datos
        // $idCompetencia
        // $ronda 
        // $idPoomsae (el correspondiente a la ronda)
        // $idCompetidor
    }

}