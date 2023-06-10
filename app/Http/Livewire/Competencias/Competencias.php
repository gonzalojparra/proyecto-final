<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use Livewire\Component;
use Livewire\WithFileUploads;


class Competencias extends Component {

    use WithFileUploads;

    protected $competencias;
    public $competencia;
    public $open = false;
    public $msj;
    public $filtro;// filtro de la tabla
    public $filtroFecha = "Todos";//filtro de la tabla por fecha
    public $titulo, $flyer,$invitacion, $bases, $descripcion, $fecha_inicio, $fecha_fin; //variables para el manejo de los datos del form


    //protected $listeners = ['recarga'=>'render'];

    public function render() {
        
        //metodo de renderizar la tabla de competencias
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

        return view('livewire.competencias.index', ['competencias' => $competenciasPedidas]);
    }

    // metodo que abre el modal con el formulario para agregar/editar una competencia
    public function agregarCompetencia()
    {
        
    }

    //Metodo para visualizar las caracteristicas de dicha competencia
    public function verCompetencia($id)
    {
        $this->emit('');
    }

    //metodo para eliminar una competencia
    public function delete($id)
    {
        Competencia::destroy($id);
    }

    public function show($id)
    {
        $competencia = Competencia::find($id);
        $this->competencia = $competencia;
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
            'invitacion'=> $urlInvitacion,
            'descripcion' => $validate['descripcion'],
            'fecha_inicio' => $validate['fecha_inicio'],
            'fecha_fin' => $validate['fecha_fin'],
        ]);

        session()->flash('msj', 'Competencia creada exitosamente.');
        $this->reset();
        $this->msj = 'Competencia creada exitosamente.';
        $this->emit('recarga',$this->msj);
    }
};