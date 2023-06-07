<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competencia;

class CompetenciaController extends Controller
{
    public function index() {
        $competencias = Competencia::get();
        return view('competencias.index', ['competencias' => $competencias]);
    }

    public function show(Competencia $Competencia) {
        return view('competencias.show', ['competencia' => $competencia]);
    }

    public function create() {
        return view('competencias.create', ['competencia' => new Competencia]);
    }

    public function store(Request $request) {
        $request->validate([
            'titulo' => ['required', 'max:120', 'unique:competencias'],
            'flyer' => ['required', 'max:120'],
            'bases' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required'],
        ]);

        Competencia::create([
            'titulo' => $request->get('titulo'),
            'flyer' => $request->get('flyer'),
            'bases' => $request->get('bases'),
            'descripcion' => $request->get('descripcion'),
            'fecha_inicio' => $request->get('fecha_inicio'),
            'fecha_fin' => $request->get('fecha_fin'),
        ]);

        return to_route('competencias.index')->with('success', 'La competencia se creo correctamente');
    }

    public function edit(Competencia $competencia) {
        return view('competencia.edit', ['competencia' => $competencia]);
    }

    public function update(Request $request, Competidor $competidor) {
        $request->validate([
            'titulo' => ['required', 'max:120', 'unique:competencias'],
            'flyer' => ['required', 'max:120'],
            'bases' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required'],
        ]);

        $competidor->update([
            'titulo' => $request->get('titulo'),
            'flyer' => $request->get('flyer'),
            'bases' => $request->get('bases'),
            'descripcion' => $request->get('descripcion'),
            'fecha_inicio' => $request->get('fecha_inicio'),
            'fecha_fin' => $request->get('fecha_fin'),
        ]);

        return to_route('competidores.show', $competidor)->with('success', 'El competidor se actualizo correctamente.');
    }
}
