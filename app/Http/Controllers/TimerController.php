<?php

namespace App\Http\Controllers;

use App\Models\Pasada;
use App\Models\Categoria;
use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimerController extends Controller {

    public $idCompetencia;

    public function index(Request $request) {
        $categorias = [];
        $competenciasCategorias = CompetenciaCategoria::where('id_competencia', $request->idCompetencia)
            ->get()
            ->toArray();
        foreach ($competenciasCategorias as $competenciaCategoria) {

            $categoriaId = $competenciaCategoria['id_categoria'];
            $categoria = Categoria::where('id', $categoriaId)
                ->get()
                ->toArray();

            $pasadas = Pasada::where('id_competencia', $competenciaCategoria['id_competencia'])
                ->where('tiempo_presentacion', null)
                ->get();

            array_push($categorias, $categoria[0]);
        }

        $this->idCompetencia = intval($request->idCompetencia);
        $competencia = Competencia::find($this->idCompetencia);

        return view('timer', ['pasadas' => $pasadas, 'categorias' => $categorias, 'competencia' => $competencia]);
    }

    public function getCompetencia() {
        return $this->idCompetencia;
    }

    public function getPasadas($competenciaId, $categoriaId) {
        $competenciaCategoria = CompetenciaCategoria::where('id_categoria', $categoriaId)
            ->where('id_competencia', $competenciaId)
            ->first();
    
        if (!$competenciaCategoria) {
            return response()->json([]);
        }
    
        $pasadas = Pasada::where('id_competencia', $competenciaCategoria->id_competencia)
            ->where('tiempo_presentacion', null)
            ->get();
    
        return $pasadas->toJson();
    }

    public function getCompetidor($competidorId) {
        $competidor = User::find($competidorId);
        if (!$competidor) {
            return response()->json([]);
        }
        return response()->json($competidor);
    }


    public function iniciarTimer($idPasada) {
        $bandera = false;
        if ($idPasada != null) {
            Pasada::where('id', $idPasada)->update(['estado_timer' => 1]);
            $bandera = true;
        }
        return $bandera;
    }

    public function pararTimer($idPasada) {
        $bandera = false;
        if ($idPasada != null) {
            Pasada::where('id', $idPasada)->update(['estado_timer' => 0]);
            $bandera = true;
        }
        return $bandera;
    }

    public function resetearTimer($idPasada) {
        $bandera = false;
        if ($idPasada != null) {
            Pasada::where('id', $idPasada)->update(['estado_timer' => 0, 'tiempo_presentacion' => 0]);
            $bandera = true;
        }
        return $bandera;
    }

    public function seleccion($idPasada) {
        $bandera = false;
        if ($idPasada != null) {
            Pasada::where('id', '!=', $idPasada)->update(['seleccionado' => 0]);
            Pasada::where('id', $idPasada)->update(['seleccionado' => 1]);
            $bandera = true;
        }
        return $bandera;
    }

    public function enviarTiempo($tiempo, $idPasada) {
        $actualizo = false;
        $pasada = Pasada::find($idPasada);
        if ($pasada->exists()) {
            $pasada->tiempo_presentacion = $tiempo;
            $pasada->save();
            $actualizo = true;
        }
        return $actualizo;
    }

    public function getPasadasJuez($idPasada) {
        $pasadasJuez = DB::table('pasadas_juez')
            ->where('id_pasada', $idPasada)
            ->get();
        return json_encode($pasadasJuez);
    }

    /**
     * Se verifica que el juez haya enviado su puntaje
     * Cuando lo envía se recupera este puntaje
     */
    public function getPuntajes($idJuez, $idPasada) {
        $data = DB::table('pasadas_juez')
            ->where('id_juez', $idJuez)
            ->where('id_pasada', $idPasada)
            ->first(); // Use first() to retrieve a single row
    
        $puntajes = [];
    
        // Check if the data is not null
        if ($data && $data->puntaje_exactitud !== null && $data->puntaje_presentacion !== null) {
            $puntajes['puntaje_exactitud'] = $data->puntaje_exactitud;
            $puntajes['puntaje_presentacion'] = $data->puntaje_presentacion;
            return response()->json($puntajes); // Return the data as JSON
        }
    
        // The field is null or not found, return an empty JSON object
        return response()->json($puntajes);
    }

    public function getJuezData($idJuez) {
        $juez = User::find($idJuez);
        if (!$juez) {
            return response()->json([]);
        }
        return response()->json($juez);
    }

}