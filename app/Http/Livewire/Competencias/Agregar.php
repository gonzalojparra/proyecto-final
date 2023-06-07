<?php

namespace App\Http\Livewire\Competencias;

use Livewire\Component;

class Agregar extends Component
{
    public $open = false;

    protected $listeners = ['abrirModal'];

    public function abrirModal()
    {
        $this->open = true;
    }
    public function render()
    {
        return view('livewire.competencias.agregar');
    }
}
