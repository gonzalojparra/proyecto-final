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
    public function create(Request $request)
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

        $categoriaFinal = Categoria::where([['nombre', '=', $catNombre], ['graduacion', '=', $catGraduacion]])->get();

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
            //'genero' => $input['genero'],
            'id_categoria' => $categoriaFinal[0]['id'],
            'graduacion' => $categoriaFinal[0]['graduacion'],
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
            'email' => $User[0]->email
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

}
