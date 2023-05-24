<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller {
    
    /**
     * Método que lista todos los permisos
     * Retorna vista
     * @param void
     */
    public function index() {
        // select id y name from permissions
        $permisos = Permission::select('id', 'name')->get();
        return $permisos;
    }
}