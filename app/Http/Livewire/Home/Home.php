<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Home extends Component
{
    public function mostrarArchivo()
    {
        $this->emit('openArchivo');
    }
    public function render()
    {
        return view('livewire.home.home');
    }
}
