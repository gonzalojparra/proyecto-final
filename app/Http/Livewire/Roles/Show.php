<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\UsuarioController;

class Show extends Component
{ 
    protected $competidor = "";
    public $filtro;

    public function render() {        
        /* $usuarios = User::all(); */
        $usuarios = User::where('name','like','%'.$this->filtro.'%')->
                            orWhere('apellido','like','%'.$this->filtro.'%')->
                            orWhere('email','like','%'.$this->filtro.'%')
                            ->get();
        return view('livewire.roles.show', compact('usuarios'));
    }

    public function mostrarCompetidor($id)
    {   
        $users = new UsuarioController;
        $user = $users->show($id);
        $this->emit('openModal',$user);
    }
}
