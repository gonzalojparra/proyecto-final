<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Descarga extends Component
{
    public $open= false;
    public $archivo = "";

    protected $listeners=['openArchivo'=>'abrirModal'];

    public function abrirModal($path){
        $this->archivo = $path;
        
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.home.descarga');
    }
}
