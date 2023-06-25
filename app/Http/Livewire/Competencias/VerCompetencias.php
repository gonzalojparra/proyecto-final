<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use App\Models\User;
use App\Models\CompetenciaCategoria;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DateTime;

use Livewire\Component;

class VerCompetencias extends Component
{
    public function render()
    {

        $competencias = Competencia::where('estado', '<>', 0)->get();
        $user = Auth::user();
 
        if ($user->hasRole('Competidor')) {
            $competenciasPublicas = [];
            
            foreach ($competencias as $competencia) {
                $categoriasCompetencia = CompetenciaCategoria::where('id_competencia', $competencia->id)->get();
                $idCategorias = [];
        
                foreach ($categoriasCompetencia as $categoriaCompetencia) {
                    $idCategorias[] = $categoriaCompetencia->id_categoria;
                }
        
                $fechaNac = $user->fecha_nac;
                $fechaActual = date('Y'); // Año actual
                $fechaNac = date("Y", strtotime($fechaNac)); // Año de nacimiento del competidor
                $edad = $fechaActual - $fechaNac;
                $bandera = false;
        
                foreach ($idCategorias as $categoria) {
                    if (($edad >= 12 && $edad <= 14 && $categoria == 1) ||
                        ($edad >= 15 && $edad <= 17 && $categoria == 2) ||
                        ($edad >= 18 && $edad <= 30 && $categoria == 3) ||
                        ($edad >= 31 && $edad <= 50 && $categoria == 4) ||
                        ($edad >= 50 && $categoria == 5)
                    ) {
                        $bandera = true;
                    }
                }
        
                if ($bandera) {
                    $competenciasPublicas[] = $competencia;
                }
            }
            // dd($competenciasPublicas);
            return view('livewire.competencias.ver-competencias', ['competencias' => $competenciasPublicas]);
        }
        return view('livewire.competencias.ver-competencias', ['competencias' => $competencias]);
        
    }

}
