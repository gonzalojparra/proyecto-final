<?php

namespace App\Http\Livewire\Competidores;

use App\Models\Graduacion;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CompetenciaCompetidor extends Component {

    protected $competidor = "";
    public $filtro;
    public $filtroCategoria;
    public $filtroGraduacion;
    public $categorias = [];
    public $graduaciones = [];
    public $escuelas = [];
    public $categoriaElegida = 'ninguna';
    public $graduacionElegida = 'ninguna';
    public $escuelaElegida = 'ninguna';
    public $orden = 'id';
    public $direccion = 'asc';
    protected $listeners = ['render' => 'render'];
    public $competenciaId;

    // Obtenemos el id de la competencia que se manda vía URL desde la vista de competencias
    public function mount( $competenciaId ){
        $this->competenciaId = $competenciaId;
    }

    public function render() {
        $usuarios = [];

        $compeCompetidorCategoriaQuery = DB::table( 'competencia_competidor' )
            ->where('id_competencia', $this->competenciaId)
            ->get();

        foreach( $compeCompetidorCategoriaQuery as $competenciaCompetidor ){
            $usuario = User::where( 'id', $competenciaCompetidor->id_competidor )
                ->where( function ($query){
                    $query->where( 'name', 'like', '%' . $this->filtro . '%' )
                        ->orWhere( 'apellido', 'like', '%' . $this->filtro . '%' );
                })
                ->orderBy( $this->orden, $this->direccion )
                ->get();

            $usuarios = array_merge( $usuarios, $usuario->toArray() );
        }

        $competidoresVerificados = array();
        foreach( $usuarios as $usuario ){
            if( $usuario['verificado'] == 1 ){
                $usuario['categoria'] = $this->obtenerCategoría( $usuario );
                if( $usuario['gal'] == NULL ){
                    $usuario['gal'] = '-';
                }

                $user = User::find( $usuario['id'] );
                $roles = $user->roles()->pluck( 'name' ); // Buscamos que rol tiene el usuario

                $nombreRol = $roles[0];
                $usuario['rol'] = $nombreRol; // Agregamos el rol al usuario.
                if( $usuario['rol'] == 'Competidor' ){
                    $competidoresVerificados[] = $usuario;
                }
                $idCategoria =  array_keys( $this->categorias, $usuario['categoria'] );
                $query = Graduacion::where('id', $usuario['id_graduacion'])->pluck('id');
                $queryArray = $query->toArray();
                $usuario['id_graduacion'] = $query[0];
                $idGraduacion = array_keys( $this->graduaciones, $usuario['id_graduacion'] );
                if( count($idCategoria) == 0 ){
                    array_push( $this->categorias, $usuario['categoria'] );
                }
                if (count($idGraduacion) == 0) {
                    array_push( $this->graduaciones, $usuario['id_graduacion'] );
                }
            }
        }
        $competidores = $this->filtrarCompetidores( $this->categoriaElegida, $this->graduacionElegida, $this->escuelaElegida, $competidoresVerificados );

        $compGraduacion = [];
        foreach( $competidores as $competidor ){
            $graduacionQuery = Graduacion::where('id', $competidor['id_graduacion'])->get();
            $array = $graduacionQuery->toArray();
            array_push($compGraduacion, $array);
        }

        return view( 'livewire.competidores.competencia-competidor', compact('competidores'), compact('compGraduacion') );
    }

    public function ordenar( $filtroOrden ){
        if( $this->orden == $filtroOrden ){
            if( $this->direccion == 'asc' ){
                $this->direccion = 'desc';
            } else {
                $this->direccion = 'asc';
            }
        } else {
            $this->orden = $filtroOrden;
            $this->direccion = 'asc';
        }
    }

    public function obtenerCategoría( $competidor ){
        $categoria = '';
        $fechaNac = $competidor['fecha_nac'];
        $fechaActual = time();
        $fechaNac = strtotime( $fechaNac );
        $edad = round( ($fechaActual - $fechaNac) / 31563000 );
        if( $edad < 8.0 ){
            $categoria = 'Precompetitivos';
        }
        if( $edad >= 8.0 && $edad <= 11.0 ){
            $categoria = 'Infantiles';
        }
        if( $edad >= 12.0 && $edad <= 14.0 ){
            $categoria = 'Cadetes';
        }
        if( $edad >= 15.0 && $edad <= 17.0 ){
            $categoria = 'Juveniles';
        }
        if( $edad >= 18.0 && $edad <= 30.0 ){
            $categoria = 'Senior 1';
        }
        if( $edad >= 31.0 && $edad <= 50.0 ){
            $categoria = 'Senior 2-Master 1';
        }
        if( $edad >= 51.0 ){
            $categoria = 'Master 2';
        }
        return $categoria;
    }

    public function filtrarCompetidores( $categoria, $graduacion, $escuela, $competidores ){
        $listaUsuarios = $competidores;
        $usuariosFiltrados = [];
        if( $this->categoriaElegida != 'ninguna' || $this->graduacionElegida != 'ninguna' || $this->escuelaElegida != 'ninguna' ){
            foreach( $listaUsuarios as $usuario ){
                if( $categoria != 'ninguna' ){
                    if( $usuario['categoria'] == $categoria ){
                        if( $graduacion != 'ninguna') {
                            if( $usuario['graduacion'] == $graduacion ){
                                if( $escuela != 'ninguna' ){
                                    if( $usuario['escuela'] == $escuela ){
                                        array_push( $usuariosFiltrados, $usuario );
                                    }
                                } else {
                                    array_push( $usuariosFiltrados, $usuario );
                                }
                            }
                        } else {
                            if( $escuela != 'ninguna' ){
                                if( $usuario['escuela'] == $escuela ){
                                    array_push( $usuariosFiltrados, $usuario );
                                }
                            } else {
                                array_push( $usuariosFiltrados, $usuario );
                            }
                        }
                    }
                } else {
                    if( $graduacion != 'ninguna' ){
                        if( $usuario['graduacion'] == $graduacion ){
                            if( $escuela != 'ninguna' ){
                                if( $usuario['escuela'] == $escuela ){
                                    array_push($usuariosFiltrados, $usuario);
                                }
                            } else {
                                array_push($usuariosFiltrados, $usuario);
                            }
                        }
                    } else {
                        if( $escuela != 'ninguna' ){
                            if( $usuario['escuela'] == $escuela ){
                                array_push($usuariosFiltrados, $usuario);
                            }
                        } else {
                            array_push($usuariosFiltrados, $usuario);
                        }
                    }
                }
            }
        } else {
            $usuariosFiltrados = $competidores;
        }
        return $usuariosFiltrados;
    }

}