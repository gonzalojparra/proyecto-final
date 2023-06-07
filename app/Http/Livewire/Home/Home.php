<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Home extends Component
{
    public $invitacion = 1;
    public $bases = 2;
    public $flyer = 3;

    protected $listeners = ['mostraNomas' => 'mostrarArc', 'descagaNomas' => 'descargaNomas'];

    public function mostrarArc($tipo)
    {
        $path = $this->armarRuta($tipo);
        $this->emit('openArchivo', $path);
    }

    public function descargaNomas($tipo)
    {
        $archivo = $this->armarRuta($tipo);
        $path = storage_path("app/public/".$archivo);
        return response()->download($path);
    }

    public function render()
    {
        return view('livewire.home.home');
    }

    private function armarRuta($id)
    {
        $ruta = "";
        if ($id == 1) {
            $ruta = "Invitacion.pdf";
        } elseif ($id == 2) {
            $ruta = "Bases.pdf";
        } else {
            $ruta = "flyerLiga.jpeg";
        }
        return $ruta;
    }
}
