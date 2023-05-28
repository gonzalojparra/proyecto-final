<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegistroUsuario extends Component
{

    public $nombreUsuario;
    public $message = "error";
    public $reglas = [
        'nombreUsuario' => 'required|max:20|string',
        'email' => 'required|email|regex:/(.*)@(gmail|yahoo|protonmail)\.com/i',
    ];

    public function render()
    {
        return view('livewire.auth.registro-usuario');
    }

    public function validar(){
        $this->validate();
        
        $this->reset(['open', 'nombre', 'correo']);
        $this->emit('render');
        $this->emit('alert', ['mensaje' => 'Se agrego correctamente']);
    } 

    // public function updatedClientName()
    // {
    //     $this->validar([
    //         'nombreUsuario' => 'required|min:3|max:128|string'
    //     ]);
    // }

}
