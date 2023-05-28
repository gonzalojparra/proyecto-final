<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegistroUsuario extends Component
{

    public $nombreUsuario;
    public  $message = "error";
 
    public function render()
    {
        return view('livewire.auth.registro-usuario');
    }

    public function updatedClientName()
    {
        $this->validar([
            'nombreUsuario' => 'required|min:3|max:128|string'
        ]);
    }

}
