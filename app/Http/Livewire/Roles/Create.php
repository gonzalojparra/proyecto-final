<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;

class Create extends Component {

    public $open = false;
    public $iduser, $nombre, $apellido, $email, $fecha_nac, $gal, $du, $clasificacion, $graduacion, $genero, $verificado, $escuela;

    protected $listeners = ['openModal' => 'mostrarUsuario'];

    public function mostrarUsuario($user) {
        $this->iduser = $user['id'];
        /* $this->nombre = $user['nombre']; */
        $this->apellido = $user['apellido'];
        $this->email = $user['email'];
        $this->fecha_nac = $user['fecha_nac'];
        $this->gal = $user['gal'];
        $this->du = $user['du'];
        $this->clasificacion = $user['clasificacion'];
        $this->graduacion = $user['graduacion'];
        $this->genero = $user['genero'];
        $this->verificado = $user['verificado'];
        $this->escuela = $user['escuela'];

        $this->open = true;
    }


    public function render() {
        return view('livewire.roles.create');
    }

    public function aceptarSolicitud($user) {
        $usuario = User::find($user);
        $seVerifico = false;
        if ($usuario !== null){
            if( $usuario->verificado == false ){
                $usuario->verificado = true;
                $usuario->save();
                $seVerifico = true;
            }
        }
        return $seVerifico;
    }

}