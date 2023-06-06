<?php

namespace App\Http\Livewire\Competidores;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class TablaCompetidores extends Component
{

    protected $competidor = "";
    public $filtro;
    public $filtroCategoria;
    public $filtroGraduacion;

    protected $listeners = ['render'=>'render'];

    public function render() {
        $usuarios = User::where('name', 'like', '%' . $this->filtro . '%')
        ->orWhere('apellido', 'like', '%' . $this->filtro . '%')
        ->orWhere('email', 'like', '%' . $this->filtro . '%')
        ->get(); // Obtenemos todos los usuarios

        $competidoresVerificados = array();
        foreach ($usuarios as $usuario) {
            if ($usuario['verificado'] == 1){
                $usuario['categoria'] = $this->obtenerCategoría($usuario);
                if ($usuario['gal'] == NULL){
                    $usuario['gal'] = '-';
                }
                $roles = $usuario->roles()->pluck('name'); // Buscamos que rol tiene el usuario
                $nombreRol = $roles[0];
                $usuario['rol'] = $nombreRol; // Agregamos el rol al usuario.
                    if ($usuario['rol'] == 'Competidor'){
                        $competidoresVerificados[] = $usuario;
                    }
            }
        }
        
    //    dd($usuarios);
            
        /* $usuarios = User::where('name', 'like', '%' . $this->filtro . '%')->orWhere('apellido', 'like', '%' . $this->filtro . '%')->orWhere('email', 'like', '%' . $this->filtro . '%')
            ->get(); */
            
        return view('livewire.competidores.tabla-competidores', compact('competidoresVerificados'));
    }

    public function obtenerCategoría($competidor){
        $categoria = '';
        $fechaNac = $competidor['fecha_nac'];
        $fechaActual = time();
        $fechaNac = strtotime($fechaNac);
        $edad = round(($fechaActual - $fechaNac)/31563000);
        if($edad >= 8.0 && $edad<= 11.0){
            $categoria = 'Infantiles';
        }
        if($edad >= 12.0 && $edad<= 14.0){
            $categoria = 'Cadete';
        }
        if($edad >= 15.0 && $edad<= 17.0){
            $categoria = 'Juveniles';
        }
        if($edad >= 18.0 && $edad<= 30.0){
            $categoria = 'Senior1';
        }
        if($edad >= 31.0 && $edad<= 50.0){
            $categoria = 'Senior2-master1';
        }
        if($edad >= 50.0){
            $categoria = 'Master2';
        }
        return $categoria;
    }

}
