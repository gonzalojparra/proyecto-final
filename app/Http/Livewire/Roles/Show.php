<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class Show extends Component {

    protected $competidor = "";
    public $filtro;

    protected $listeners = ['render'=>'render'];

    public function render() {
        $usuarios = User::get(); // Obtenemos todos los usuarios
        $usuariosPendientes = array();
        foreach ($usuarios as $usuario) {
            if ($usuario['verificado'] == 0) { // Filtramos a los usuarios q no estan verificados
                $roles = $usuario->roles()->pluck('name'); // Buscamos que rol tiene el usuario
                $nombreRol = $roles[0];
                $usuario['rol'] = $nombreRol; // Agregamos el rol al usuario.
                $usuariosPendientes[] = $usuario;
            }
        }
        
        /* dd($usuariosArray); */
            
        /* $usuarios = User::where('name', 'like', '%' . $this->filtro . '%')->orWhere('apellido', 'like', '%' . $this->filtro . '%')->orWhere('email', 'like', '%' . $this->filtro . '%')
            ->get(); */
            
        return view('livewire.roles.show', compact('usuariosPendientes'));
    }



    public function mostrarCompetidor($id) {
        $users = new UserController();
        $user = $users->show($id);
        $this->emit('openModal', $user);
    }

}