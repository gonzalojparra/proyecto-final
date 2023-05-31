<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;

class Create extends Component {

    public $open = false;
    public $nombre, $apellido, $email;

    protected $listeners = ['openModal' => 'mostrarUsuario'];

    public function mostrarUsuario($user) {
        $this->nombre = $user['nombre'];
        $this->apellido = $user['apellido'];
        $this->email = $user['email'];

        $this->open = true;
    }


    public function render() {
        return view('livewire.roles.create');
    }

}