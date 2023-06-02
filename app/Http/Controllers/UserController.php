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
use Spatie\Permission\Models\Role; // Spatie

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
    public function create()
    {
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
        if($catNombre == null && $catGraduacion == null){
            $categoriaFinalId = null;
            $categoriaFinalGr = null;
        } else {
            $categoriaFinal = Categoria::where([['nombre', '=', $catNombre], ['graduacion', '=', $catGraduacion]])->get();
            $categoriaFinalId =$categoriaFinal[0]['id'];
            $categoriaFinalGr = $categoriaFinal[0]['graduacion'];
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
            'genero' => $input['genero'],
            'id_categoria' => $categoriaFinalId,
            'graduacion' => $categoriaFinalGr,
            'id_escuela' => $escuela[0]->id,
        ]);
        
        if( $escuela !== null ){
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
    public function show($user)
    {
        $User = User::where('id', $user)->get();
        /* var_dump($User); */

        $usuario = [
            'nombre' => $User[0]->name,
            'apellido' => $User[0]->apellido,
            'email' => $User[0]->email,
        ];
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    // Metodos personalizados

    /**
     * Devuelve un json con todos los usuarios pendientes a registrar e incluimos el rol a asignar.
     * Accedemos al rol con la clave 'rol';
     */
    public function mostrarPendientes(){
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
     * Cuando el admin acepte o rechace la solicitud llama a este metodo
     * Recibe 2 parametros, el id del usuario a verificar y el estado.
     * El estado puede ser 'si' o 'no'
     * Si es 'si' verifica el usuario y lo habilita para el logeo.
     * Si es 'no' elimina el usuario de la bd
     */
    public function verificarUsuario($user, $estado){
        $usuario = User::find($user);
        $seVerifico = false;
        if ($usuario !== null){
            if ($estado == 'si'){
                $usuario->verificado = true;
                $usuario->save();
                return $usuario;
            } else{
                $usuario->delete();
            }
        }
    }
}
