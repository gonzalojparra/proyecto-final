<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
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
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        /* $request->validate([
            'id_user' => ['required'],
            'gal' => ['required', 'unique:competidores'],
            'du' => ['required'],
            'genero' => ['required'],
            'id_colegio' => ['required'],
            'graduacion' => ['required'],
            'clasificacion' => ['required'],
            'id_categoria' => ['required'],
            'id_pais' => ['required'],
            //'fecha_nac' => ['required'],
        ]); */

        User::create([
            'name' => $request->get('name'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'fecha_nac' => $request->get('fecha_nac'),
            'id_escuela' => $request->get('escuela'),
            'gal' => $request->get('gal'),
            'du' => $request->get('documento'),
            // 'clasificacion' => $request->get('clasificacion'),
            'graduacion' => $request->get('graduacion'),
            'id_categoria' => $request->get('categoria'),
            'genero' => $request->get('genero'),
        ]);

        return to_route('competidores.index')->with('success', 'El competidor se creo correctamente');
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
