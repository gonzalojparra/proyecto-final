<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use Livewire\Component;
use Livewire\WithFileUploads;

class Agregar extends Component
{
    use WithFileUploads;

    public $open = false;
    protected $competencia;
    public $titulo, $flyer, $bases, $invitacion, $descripcion, $fecha_inicio, $fecha_fin;

    protected $listeners = [
        'abrirModal',
        'mostrarDatos'=>'show'
    ];

    public function render()
    {
        return view('livewire.competencias.agregar');
    }

    public function abrirModal()
    {
        $this->open=true;
    }
    public function cerrarModal()
    {
        $this->reset();
        $this->open=false;
    }

    public function create()
    {
        $validate = $this->validate([
            'titulo' => ['required', 'max:120', 'unique:competencias'],
            'flyer' => ['required', 'image', 'max:2048'],
            'bases' => ['required', 'mimes:pdf,docx'],
            'invitacion' => ['required', 'mimes:pdf,docx'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
        ]);

        $urlImagen = $this->flyer->store('competencias', 'public');
        $urlBases = $this->bases->store('competencias', 'public');
        $urlInvitacion = $this->bases->store('competencias', 'public');
        Competencia::create([
            'titulo' => $validate['titulo'],
            'flyer' => $urlImagen,
            'bases' => $urlBases,
            'invitacion'=>$urlInvitacion,
            'descripcion' => $validate['descripcion'],
            'fecha_inicio' => $validate['fecha_inicio'],
            'fecha_fin' => $validate['fecha_fin'],
        ]);

        session()->flash('msj', 'Competencia creada exitosamente.');
        $this->reset();
        $this->emit('recarga');
    }

    public function show($id)
    {
        $competencia = Competencia::find($id);
        $this->titulo = $competencia->titulo;
        $this->descripcion = $competencia->descripcion;
        $this->fecha_inicio= $competencia->fecha_inicio;
        $this->fecha_fin = $competencia->fecha_fin;
        
        $this->open = true;
    }
}
