<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller {
    // Listar
    public function index() {
        $roles = Role::select('id', 'name')->with('permissions')->orderByDesc('id')->get();
        return $roles;
    }

    // Crear
    public function store() {

    }

    // Actualizar
    public function update( Request $request, Role $role ){

    }

    // Eliminar
    public function destroy( $id ){

    }
}