<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Descarga extends Component
{
    public $open= false;
    public $archivo = "";

    protected $listeners=['openArchivo'=>'abrirModal'];

    public function abrirModal(){
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.home.descarga');
    }
}
