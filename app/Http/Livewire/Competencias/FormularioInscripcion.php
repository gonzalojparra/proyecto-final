<?php

namespace App\Http\Livewire\Competencias;

use App\Http\Middleware\Authenticate;
use App\Models\Categoria;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Team;
use DragonCode\Contracts\Cashier\Auth\Auth as AuthAuth;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SebastianBergmann\CodeUnit\FunctionUnit;

class FormularioInscripcion extends Component
{
    public $open = false;
    public $nombre;
    public $apellido;
    public $email;
    public $fechaNac;
    public $escuela;
    public $escuelaInicial;
    public $graduacionInicial;
    public $du;
    public $graduacion;
    public $idUsuario;
    public $editarGraduacion = 'disable';
    public $editarEscuela = 'disable';
    public $categoria;
    public $id_categoria=1;
    public $poomsae;
    public $idCompetencia;
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
    //falta 
    //deshabilitar el select (no me salio)
    //enviar solicitud de edicion al admin -> esto se saca desde la vista del admin con el atributo "inscripto"
    //si es juez, cargar datos a competencia_juez
    //si es competidor, cargar datos a competencia_competidor 
    //enviar solicitud de aprobación de inscripción al admin -> esto se saca de la vista del admin, habría que agregar dos atributos con timestamp
    // "modificacion" y "ultima_modificacion"
    //sortear los poomsaes -> HECHO
    //resolver la tabla de categorias para sacar de ahi el id
    //obtener el id de la competencia
    //agregar el GAL si se modifica el cinturon a negro

    protected $listeners = ['abrirModal' => 'abrirModal'];

    public function render()
    {
        // $this->sortPoomsae( "3 GUP, Azul borde rojo",1);
        $this->botonEscuela = 'Actualizar';
        $this->botonGraduacion = 'Actualizar';
        $this->escuelas = Team::all()->pluck('name');
        return view('livewire.competencias.formulario-inscripcion');
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
        $this->sortPoomsae($this->graduacion);
        $competencia_competidor = new CompetenciaCompetidor();
        $competencia_competidor->id_competencia = $this->idCompetencia;
        $competencia_competidor->id_competidor = $this->idUsuario;
        $competencia_competidor->id_poomsae = $this->poomsae;
        $competencia_competidor->id_categoria = $this->id_categoria;
        $this->calcularCategoria();
        $competencia_competidor->calificacion = null;
        $competencia_competidor->tiempo_presentacion = null;
        $competencia_competidor->aprobado = false;
        $competencia_competidor->save();
    }

    //hay que modificar la bd, inscripto es un timestamp, y no se puede mandar nulo, debería ser "aceptado" como en competencia_competidor
    public function crearJuez()
    {
        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->id_competencia = $this->idCompetencia;
        $competencia_juez->id_juez = $this->idUsuario;
        $competencia_juez->inscripto = false;
        $competencia_juez->save();
    }
    // ? $this->emit('confirmacion', true) : $this->emit('confirmacion', false)

    private function calcularCategoria()
    {
        $categoria = '';
        $fechaActual = time();
        $fechaNac = strtotime($this->fechaNac);
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
        $this->categoria = $categoria;
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
                $this->poomsae = rand(3, 8);
                break;
            case 1:
                $this->poomsae = rand(3, 8);
                break;
            case 2:
                $this->poomsae = rand(3, 8);
                break;
            case 3:
                $this->poomsae = rand(1, 6);
                break;
            case 4:
                $this->poomsae = rand(1, 6);
                break;
            case 5:
                $this->poomsae = rand(1, 6);
                break;
            case 6:
                $this->poomsae = rand(1, 3);
                break;
            case 7:
                $this->poomsae = rand(1, 3);
                break;
            case 8:
                $this->poomsae = rand(1, 3);
                break;
            case 9:
                $this->poomsae = 1;
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
