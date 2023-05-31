<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\UsuarioController;

class Show extends Component
{ 
    protected $competidor = "";
    

    public function render()
    {        
        $usuarios = User::all();
        return view('livewire.roles.show', compact('usuarios'));
    }

    public function mostrarCompetidor($id)
    {   
        $users = new UsuarioController;
        $user = $users->show($id);
        $this->emit('openModal',$user);
    }
}
