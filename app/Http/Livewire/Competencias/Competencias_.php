<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use Livewire\Component;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;


class _Competencias extends Component {

    use WithFileUploads;

    protected $competencias;
    public $competencia;
    public $filtro;
    public $filtroFecha = "Todos";
    public $titulo, $flyer, $bases, $descripcion, $fecha_inicio, $fecha_fin;


    //protected $listeners = ['abrirModal'=>'agregarCompetencia'];

    public function render() {
        $competencias = Competencia::where('titulo', 'like', '%' . $this->filtro . '%')->get();
        $fechaActual = date("Y-m-d");
        $competenciasPedidas = $competencias;

        if (isset($this->filtroFecha)){
            if ($this->filtroFecha == 'en-curso'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_inicio'] <= $fechaActual && $fechaActual <= $competencia['fecha_fin']){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            } elseif ($this->filtroFecha == 'proximos'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_inicio'] > $fechaActual){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            } elseif ($this->filtroFecha == 'finalizados'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_fin'] < $fechaActual){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            }
        }

        return view('livewire.competencias.create', ['competencias' => $competenciasPedidas]);
    }

    public function agregarCompetencia()
    {
        $this->emit('abrirModal');
    }

    public function create()
    {
        $validate = $this->validate([
            'titulo' => ['required', 'max:120', 'unique:competencias'],
            'flyer' => ['required', 'image', 'max:2048'],
            'bases' => ['required', 'mimes:pdf,docx'],
            'descripcion' => ['required', 'max:120'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
        ]);

        $urlImagen = $this->flyer->store('competencias', 'public');
        $urlPdf = $this->bases->store('competencias', 'public');

        Competencia::create([
            'titulo' => $validate['titulo'],
            'flyer' => $urlImagen,
            'bases' => $urlPdf,
            'descripcion' => $validate['descripcion'],
            'fecha_inicio' => $validate['fecha_inicio'],
            'fecha_fin' => $validate['fecha_fin'],
        ]);

        session()->flash('msj', 'Competencia creada exitosamente.');
        $this->reset();
    }

    
    public function show($id)
    {
        $competencia = Competencia::find($id);
        $this->competencia = $competencia;
    }

    public function delete($id)
    {
        Competencia::destroy($id);
    }
};