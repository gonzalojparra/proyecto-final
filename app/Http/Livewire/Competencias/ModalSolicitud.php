<?php

namespace App\Http\Livewire\Competencias;

use App\Mail\MailPrueba;
use App\Models\Actualizaciones;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ModalSolicitud extends Component
{
    public $open = false;
    public $escuela, $gal, $graduacion, $inputNuevoDato, $idcompetidor;


    protected $listeners=[
        'mostrarCambioSilicitado' => 'mostrarCambioSilicitado'
    ];

    public function mostrarCambioSilicitado($id)
    {        
        $this->idcompetidor = $id;

        $solicitud = Actualizaciones::where('id_user',$id)->get();
        $competidor = User::where('id',$id)->select('id_escuela','graduacion','gal')->get();
        
        $this->escuela = ($competidor[0]->id_escuela === $solicitud[0]->id_escuela_nueva)? null : $solicitud[0]->id_escuela_nueva;
        $this->graduacion = ($solicitud[0]->graduacion === $competidor[0]->graduacion)? null : $solicitud[0]->graduacion;
        $this->gal = ($solicitud[0]->gal === $competidor[0]->gal)? null : $solicitud[0]->gal;
        
        $this->open=true;
    }

    public function aceptarCambio()
    {
       
        $competidor = User::find($this->idcompetidor);
        if(!empty($this->escuela)){$competidor->id_escuela = $this->escuela;}
        if(!empty($this->gal)){$competidor->id_escuela = $this->gal;}
        if(!empty($this->graduacion)){$competidor->id_escuela = $this->graduacion;}
        if($competidor->save()){
            Actualizaciones::where('id_user',$this->idcompetidor)->delete();
        };

        $this->open = false;
        Mail::to($competidor->email)->send(new MailPrueba('inscripcionAceptada'));
        $this->emit('aceptado');
    }

    public function rechazarCambio()
    {

        Actualizaciones::where('id_user',$this->idcompetidor)->delete();
        $this->open = false;
        Mail::to(User::find($this->idcompetidor)->pluck('email')[0])->send(new MailPrueba('inscripcionRechazada'));
        $this->emit('aceptado');
    }


    public function render()
    {
        return view('livewire.competencias.modal-solicitud');
    }
}
