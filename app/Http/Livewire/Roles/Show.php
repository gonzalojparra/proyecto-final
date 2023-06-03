<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
<<<<<<< Updated upstream
use App\Http\Controllers\UsuarioController;
=======
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Show extends Component
{
>>>>>>> Stashed changes

class Show extends Component
{ 
    protected $competidor = "";
    public $filtro;

    public function render() {
        $usurios = User::all();
        $usuarios = DB::table('model_has_roles')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id' )
            ->select(['users.*', 'roles.*'])
            ->where('users.name', 'like', '%' . $this->filtro . '%')->orWhere('users.apellido', 'like', '%' . $this->filtro . '%')->orWhere('users.email', 'like', '%' . $this->filtro . '%')->orWhere('roles.name', 'like', '%' . $this->filtro . '%')
            ->get();
        $usuariosArray = $usuarios->toArray();
        /* dd($usuariosArray); */
            
        /* $usuarios = User::where('name', 'like', '%' . $this->filtro . '%')->orWhere('apellido', 'like', '%' . $this->filtro . '%')->orWhere('email', 'like', '%' . $this->filtro . '%')
            ->get(); */
            
        return view('livewire.roles.show', compact('usuariosArray'));
    }


    public function mostrarCompetidor($userEmail) {
        $users = new UserController;
        $user = $users->show($userEmail);
        
        $this->emit('openModal', $user);
>>>>>>> Stashed changes
    }
}
