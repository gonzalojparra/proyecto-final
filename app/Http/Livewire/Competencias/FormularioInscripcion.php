<?php

namespace App\Http\Livewire\Competencias;

use App\Http\Middleware\Authenticate;
use App\Models\Actualizaciones;
use App\Models\Categoria;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Team;
use DragonCode\Contracts\Cashier\Auth\Auth as AuthAuth;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Illuminate\Support\Facades\DB;

class FormularioInscripcion extends Component
{
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
    public $editarGraduacion = 'disable';
    public $editarEscuela = 'disable';
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
    public $poomsaes = [
        '1' => 'TAEGUK IL CHANG',
        '2' => 'TAEGUK I CHANG',
        '3' => 'TAEGUK SAM CHANG',
        '4' => 'TAEGUK SAH CHANG',
        '5' => 'TAEGUK OH CHANG',
        '6' => 'TAEGUK YOUK CHANG',
        '7' => 'TAEGUK CHILK CHANG',
        '8' => 'TAEGUK PAL CHANG',
        '9' => 'KORYO',
        '10' => 'KUMGANG',
        '11' => 'TAEBEK',
        '12' => 'PYONGWON',
        '13' => 'SIPJIN',
        '14' => 'CHITAE',
        '15' => 'CHUNGKWON',
        '16' => 'HANSU'
    ];

    //TO DO 
    //falta validar el gal, que tenga 3 letras y 7 numeros

    //SORTEAR POOMSAES NATALIA TE ODIOOOO ->  esto se hace cuando se crea una competencia
    //asignar el poomsae desde el listado de la bd


    protected $listeners = ['abrirModal' => 'abrirModal'];

    public function mount($competenciaId)
    {
        $this->idCompetencia = $competenciaId;
    }

    public function render()
    {
        $this->graduacionesDisponibles();
        $this->categorias = Categoria::All();
        $this->botonEscuela = 'Actualizar';
        $this->botonGraduacion = 'Actualizar';
        $this->botonGal = 'Actualizar';
        $this->escuelas = Team::all();
        return view('livewire.competencias.formulario-inscripcion');
    }

    public function graduacionesDisponibles()
    {
        $idGraduacion = array_search($this->graduacionInicial, $this->graduaciones);
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
        $this->graduacion = $usuario->graduacion;
        $this->gal = $usuario->gal;
        $this->galInicial = $usuario->gal;
        $this->open = true;
        $this->idCompetencia = $idCompetencia;
        $this->escuelaInicial = Team::where('id', $usuario->id_escuela)->pluck('name');
        $this->graduacionInicial = $usuario->graduacion;
    }

    public function create()
    {
        if ($this->graduacion != NULL) {
            $this->crearCompetidor();
        } else {
            $this->crearJuez();
        }
        $this->open = false;
    }

    public function crearCompetidor()
    {
        $creado = false;
        $this->calcularCategoria();
        $this->compararDatos();
        $esta = $this->revisarSiUserEsta();
        if (!$esta) {
            // $this->sortPoomsae($this->graduacion);
            $competencia_competidor = new CompetenciaCompetidor();
            $competencia_competidor->id_competencia = $this->idCompetencia;
            $competencia_competidor->id_competidor = $this->idUsuario;
            $competencia_competidor->id_poomsae = $this->poomsae;
            $competencia_competidor->id_categoria = $this->idCategoria;
            $this->calcularCategoria();
            $competencia_competidor->calificacion = null;
            $competencia_competidor->tiempo_presentacion = null;
            $competencia_competidor->aprobado = false;
            $competencia_competidor->save();
            $creado = true;
            session()->flash('success', '¡Inscripción exitosa!');
        } else {
            session()->flash('error', '¡Ya estás inscrito en esta competencia!');
        }
        return $creado;
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
        $esta = $this->revisarSiUserEsta();
        $this->compararDatos();
        if (!$esta) {
            $competencia_juez = new CompetenciaJuez();
            $competencia_juez->id_competencia = $this->idCompetencia;
            $competencia_juez->id_juez = $this->idUsuario;
            $competencia_juez->aprobado = false;
            $competencia_juez->save();
        }
    }
    // ? $this->emit('confirmacion', true) : $this->emit('confirmacion', false)


    public function compararDatos()
    {
        $actualizacion = new Actualizaciones();
        $actualizar = false;
        $actualizacion->id_user = $this->idUsuario;
        if ($this->escuelaInicial != $this->escuela) {
            $idEscuela =  Team::where('name', $this->escuela)->pluck('id');
            $actualizacion->id_colegio_nuevo = $idEscuela[0];
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
            $actualizacion->id_colegio_nuevo = 0;
            $actualizacion->graduacion_nueva = $this->graduacion;
            $actualizar = true;
        } else {
            if ($this->galInicial != $this->gal) {
                $actualizacion->gal_nuevo = $this->gal;
                $actualizar = true;
            }
        }

        if ($actualizar) {
            $actualizacion->save();
        }
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
        } else {
            $graduacionRequerida = $this->graduaciones[10];
            if ($this->graduacionInicial != $graduacionRequerida && $this->graduacion == $graduacionRequerida || $this->galInicial == null) {
                if ($this->editarGal == 'readonly') {
                    $this->editarGal = '';
                }
            }
        }
    }

    private function calcularCategoria()
    {
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

        // $categoria = '';
        // $fechaActual = time();
        // $fechaNac = strtotime($this->fechaNac);
        // $edad = round(($fechaActual - $fechaNac) / 31563000);
        // if ($edad >= 8.0 && $edad <= 11.0) {
        //     $categoria = 'Infantiles';
        // }
        // if ($edad >= 12.0 && $edad <= 14.0) {
        //     $categoria = 'Cadete';
        // }
        // if ($edad >= 15.0 && $edad <= 17.0) {
        //     $categoria = 'Juveniles';
        // }
        // if ($edad >= 18.0 && $edad <= 30.0) {
        //     $categoria = 'Senior1';
        // }
        // if ($edad >= 31.0 && $edad <= 50.0) {
        //     $categoria = 'Senior2-master1';
        // }
        // if ($edad >= 50.0) {
        //     $categoria = 'Master2';
        // }
        // $this->categoria = $categoria;

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

    public function sortPoomsae($graduacion)
    {
        $this->poomsaes;
        $graduacionCompetidor = array_search($graduacion, $this->graduaciones);
        switch ($graduacionCompetidor) {
            case 0:
                $this->poomsae = 1;
                break;
            case 1:
                $this->poomsae = rand(1, 3);
                break;
            case 2:
                $this->poomsae = rand(1, 3);
                break;
            case 3:
                $this->poomsae = rand(1, 3);
                break;
            case 4:
                $this->poomsae = rand(1, 6);
                break;
            case 5:
                $this->poomsae = rand(1, 6);
                break;
            case 6:
                $this->poomsae = rand(1, 6);
                break;
            case 7:
                $this->poomsae = rand(3, 8);
                break;
            case 8:
                $this->poomsae = rand(3, 8);
                break;
            case 9:
                $this->poomsae = rand(3, 8);
                break;
            default:
                switch ($this->categoria) {
                    case 'Cadete':
                        $this->poomsae = rand(4, 10);
                        break;
                    case 'Juvenil':
                        $this->poomsae = rand(4, 11);
                        break;
                    case 'Senior 1':
                        $this->poomsae = rand(4, 12);
                        break;
                    case 'Senior 2':
                        $this->poomsae = rand(4, 13);
                        break;
                    case 'master 1':
                        $this->poomsae = rand(4, 13);
                        break;
                    default:
                        $this->poomsae = rand(4, 16);
                        break;
                }
                break;
        }
    }
}
