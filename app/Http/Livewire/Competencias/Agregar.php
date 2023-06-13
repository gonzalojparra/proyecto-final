<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithFileUploads;

class Agregar extends Component
{
    use WithFileUploads;

    protected $competencia;
    protected $categorias;
    public $open = false;
    public $boton, $accionForm ;
    public $titulo, $flyer, $bases, $invitacion, $descripcion, $fecha_inicio, $fecha_fin, $idCompetencia;
    public $categoria = array();

    protected $listeners = [
        'abrirModal',
        'mostrarDatos'=>'show'
    ];

    public function render()
    {
        $this->categorias = Categoria::get();
        $categorias = $this->categorias;
        return view('livewire.competencias.agregar', ['categorias' => $categorias]);
    }

    public function abrirModal($accion)
    {
        $this->boton = $accion;
        $this->accionForm = 'create';
        $this->open=true;
    }
    public function cerrarModal()
    {
        $this->open=false;
        $this->reset();
        
    }

    public function create()
    {
        $catDisponibles = array();
        $nombreCat = null;
        $categorias = Categoria::get();
        foreach ($categorias as $categoria) {
            if ($nombreCat != $categoria->nombre){
                $catDisponibles[] = $categoria->nombre;
            }
            $nombreCat = $categoria->nombre;
        }

        $validate = $this->validate([
            'titulo' => ['required', 'max:120', 'unique:competencias'],
            'flyer' => ['required', 'image', 'max:2048'],
            'bases' => ['required', 'mimes:pdf,docx'],
            'invitacion' => ['required', 'mimes:pdf,docx'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
            'categoria' => ['required', 'array'],
        ]);

        $urlImagen = $this->flyer->store('competencias', 'public');
        $urlBases = $this->bases->store('competencias', 'public');
        $urlInvitacion = $this->bases->store('competencias', 'public');

        $competencia = Competencia::create([
            'titulo' => $validate['titulo'],
            'flyer' => $urlImagen,
            'bases' => $urlBases,
            'invitacion'=>$urlInvitacion,
            'descripcion' => $validate['descripcion'],
            'fecha_inicio' => $validate['fecha_inicio'],
            'fecha_fin' => $validate['fecha_fin'],
        ]);

        $categoria = $validate['categoria'];
        
        if (count($categoria) > 0){
            foreach ($categoria as $idCategoria) {
                CompetenciaCategoria::create([
                    'id_competencia' => $competencia->id,
                    'id_categoria' => $idCategoria,
                ]);
            }
        }

        session()->flash('msj', 'Competencia creada exitosamente.');
        $this->reset();
        $this->emit('recarga');
    }

    public function update(){

        $validate = $this->validate([
            'titulo' => ['required', 'max:120'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
        ]);
        
        $competencia = Competencia::find($this->idCompetencia);
        $competencia->titulo = $validate['titulo'];
        $competencia->descripcion = $validate['descripcion'];
        $competencia->fecha_inicio = $validate['fecha_inicio'];
        $competencia->fecha_fin = $validate['fecha_fin'];

        

        $competencia->save() ? $this->emit('msjAccion',true) : $this->emit('msjAccion',false);
        $this->open = false;
        $this->emit('recarga');
    }

    public function show($parametros)
    {
        $this->boton = $parametros[1];
        $this->accionForm = 'update';

        $competencia = Competencia::find($parametros[0]);
        $this->idCompetencia = $competencia->id;
        $this->titulo = $competencia->titulo;
        $this->descripcion = $competencia->descripcion;
        $this->fecha_inicio= $competencia->fecha_inicio;
        $this->fecha_fin = $competencia->fecha_fin;
        
        $this->open = true;
    }

    public function cerrarConvocatoria($id)
    {
        $competencia = Competencia::find($id);
        $competencia->estado = 3;
        
        $competencia->save() ? $this->emit('msjAccion',true) : $this->emit('msjAccion',false);
        $this->open = false;
        $this->emit('recarga');
    }
}
