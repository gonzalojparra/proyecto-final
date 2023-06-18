<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Categoria;
use App\Models\Team;
use App\Models\Competencia;
use App\Models\Graduacion;
use Spatie\Permission\Models\Role; // Spatie
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $escuelas = Team::all();

        return view('auth.register', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Buscar categoría
        $catNombre = $input['categoria'];
        $catGraduacion = $input['graduacion'];
        $graduacionQuery = Graduacion::where('nombre', $catGraduacion)->get();
        $graduacion = $graduacionQuery->toArray();

        $genero = null;
        if (array_key_exists('genero', $input)) {
            $genero = $input['genero'];
        }
        if ($catNombre == null && $catGraduacion == null) {
            $categoriaFinalId = null;
            $categoriaFinalGr = null;
        } else {
            $categoriaFinal = Categoria::where('nombre', $catNombre)->get();
            $categoriaFinalId = $categoriaFinal[0]['id'];
        }


        // Buscar escuela
        $escuela = Team::where('name', $input['escuela'])->get();
        $usuario = User::create([
            'name' => $input['name'],
            'apellido' => $input['apellido'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'du' => $input['documento'],
            'fecha_nac' => $input['fechaNac'],
            'gal' => $input['gal'],
            'genero' => $genero,
            
            'id_escuela' => $escuela[0]->id,
        ]);

        if ($escuela !== null) {
            // Asignar rol en tabla de spatie
            $usuario->assignRole($input['rol']);
            // Asignar usuario a la escuela en tabla de team
            $escuela[0]->users()->attach(
                Jetstream::findUserByEmailOrFail($input['email']),
                ['role' => $input['rol']]
            );
            $usuario->switchTeam($escuela[0]);
            $usuario->ownedTeams()->save($escuela[0]);
            return view('auth.login');
        } else {
            return view('auth.register');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($userId) {

    //     $userQuery = User::where('id', $userId)->get();
    //     $User = $userQuery->toArray();
    //     $escuela = $userQuery[0]->teams()->pluck('name');


    //     $User = $userQuery->toArray();
    //     $usuario = [
    //         'id' => (empty($User[0]['id'])) ? null : $User[0]['id'],
    //         'nombre' => (empty($User[0]['name'])) ? null : $User[0]['name'],
    //         'apellido' => (empty($User[0]['apellido'])) ? null : $User[0]['apellido'],
    //         'email' => (empty($User[0]['email'])) ? null : $User[0]['email'],
    //         'fecha_nac' => (empty($User[0]['fecha_nac'])) ? null : $User[0]['fecha_nac'],
    //         'gal' => (empty($User[0]['gal'])) ? null : $User[0]['gal'],
    //         'du' => (empty($User[0]['du'])) ? null : $User[0]['du'],
    //         'clasificacion' => (empty($User[0]['clasificacion'])) ? null : $User[0]['clasificacion'],
    //         'graduacion' => (empty($User[0]['graduacion'])) ? null : $User[0]['graduacion'],
    //         'genero' => (empty($User[0]['genero'])) ? null : $User[0]['genero'],
    //         'verificado' => (empty($User[0]['verificado'])) ? null : $User[0]['verificado'],
    //         'escuela' => $escuela[0],
    //     ];

    //     return $usuario;
    // }

    public function show($id){
        $usuario = User::find($id);
        $escuela = Team::find($usuario['id_escuela']);
        $usuario['escuela'] = $escuela['name'];
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
        //
    }


    // Metodos personalizados

    /**
     * Devuelve un json con todos los usuarios pendientes a registrar e incluimos el rol a asignar.
     * Accedemos al rol con la clave 'rol';
     */
    public function mostrarPendientes() {
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
        return $usuariosPendientes;
    }

    /**
     * Permite cargar una competencia y las categorias que participan en ella.
     * Se crea una instancia de competencia_categoria
     */
    /*  public function cargarCompetencia(){
        $competenciaId = Competencia::where
    } */

    /**
     * Cuando el admin acepte o rechace la solicitud llama a este metodo
     * Recibe 2 parametros, el id del usuario a verificar y el estado.
     * El estado puede ser 'si' o 'no'
     * Si es 'si' verifica el usuario y lo habilita para el logeo.
     * Si es 'no' elimina el usuario de la bd
     */
    public function verificarUsuario($user, $estado) {
        $usuario = User::find($user);
        $seVerifico = false;
        if ($usuario !== null) {
            if ($estado == 'si') {
                $usuario->verificado = true;
                $usuario->save();
                return $usuario;
            } else {
                $usuario->delete();
            }
        }
    }

}