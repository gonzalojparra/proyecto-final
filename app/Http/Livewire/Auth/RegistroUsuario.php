<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegistroUsuario extends Component
{

    public $nombreUsuario, $apellidoUsuario ,$email, $contrasenia, $contraseniaConfirmada;
    protected $reglas = [
        'nombreUsuario' => 'required|max:20|min:3|string',
        'apellidoUsuario' => 'required|max:20|min:3|string',
        'email' => 'required|email|regex:/(.*)@(gmail|yahoo|protonmail)\.com/i',
        'contrasenia' => 'required|min:8|same:contraseniaConfirmada',
    ];

    protected $messages = [
        'email.required' => 'Por favor ingrese su email',
        'email.email' => 'El email ingresado no es válido',
        'nombreUsuario.required' => 'Por favor ingrese su nombre',
        'nombreUsuario.string' => 'Ingrese únicamente letras',
        'nombreUsuario.largo' => 'Demasiados caracteres',
        'apellidoUsuario.required' => 'Por favor ingrese su apellido',
        'apellidoUsuario.string' => 'Ingrese únicamente letras',
        'apellidoUsuario.largo' => 'Demasiados caracteres',
        
    ];

    public function render()
    {
        return view('livewire.auth.registro-usuario');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
