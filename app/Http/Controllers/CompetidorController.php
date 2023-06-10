<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Competencia;
use App\Models\Categoria;
use App\Models\Team;
use App\Models\SolicitudActualizacion;
use Spatie\Permission\Models\Role; // Spatie

class CompetidorController extends Controller
{

    public function __construct()
    {
        // Para proteger todas las rutas(index, show, create...) de los roles que no tienen permisos:
        // $this->middleware('can:competidores.index');

        // Para proteger una ruta especifica(ejem: index) de los roles que no tienen permisos:
        // Usamos metodo only para especificar el metodo.
        //$this->middleware('can:competidores.index')->only('index');

        // Para proteger dos rutas o mas:
        // $this->middleware('can:competidores.edit')->only('edit', 'update');
    }

    // Mostramos todos los competidores que estan en la bd.
    public function index()
    {
        $competidores = Competidor::get();
        return view('competidores.index', ['competidores' => $competidores]);
    }

    // Mostramos el competidor recibido en el parametro.
    public function show(Competidor $competidor)
    {
        return view('competidores.show', ['competidor' => $competidor]);
    }

    // Mostramos la vista del formulario con create.
    public function create()
    {
        $competidor = DB::table('users')
            ->select('id', 'gal', 'graduacion', 'id_escuela') // Especifica las columnas que deseas seleccionar
            ->where('id', 10)    // Agrega tus condiciones de filtrado
            ->first();

        $escuela = DB::table('teams')
            ->select('id', 'name') // Especifica las columnas que deseas seleccionar
            ->where('id', $competidor->id_escuela)    // Agrega tus condiciones de filtrado
            ->first();


        return view('competidores.create', compact('competidor', 'escuela'));
    }

    // Buscar pais precargado en la base de datos
    public function buscarPaises(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $paises = Pais::orderBy('nombre', 'asc')->limit(5)->pluck('nombre');
        } else {
            $paises = Pais::orderBy('nombre', 'asc')->where('nombre', 'like', '%' . $search . '%')->limit(5)->pluck('nombre');
        }

        return response()->json($paises);
    }

    // Buscar colegios 
    public function buscarColegio(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $paises = DB::table('pais')
                ->orderBy('nombre', 'asc')
                ->limit(5)
                ->pluck('nombre');
        } else {
            $paises = DB::table('pais')
                ->orderBy('nombre', 'asc')
                ->where('nombre', 'like', '%' . $search . '%')
                ->limit(5)
                ->pluck('nombre');
        }

        return response()->json($paises);
    }


    // Si ya esta cargado el competidor, se autocompleta el formulario
    public function buscarCompetidor(Request $request)
    {

        $columnName = 'du';
        $data = $request->input('du');

        $competidor = Competidor::where($columnName, $data)->get();

        /*  if ($competidor->count() > 0) {
            // Hay resultados en la base de datos
            return response()->json($competidor);
        } else {
            // No se encontraron resultados en la base de datos
            return response()->json(['error' => 'Modelo no encontrado'], 404);
        }

        return response()->json($competidor); */
        dd($competidor);
        return $competidor;
    }

    // Inscribir competidor
    public function inscripcion()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
            
        // Obtener todos los equipos
        $teams = Team::all();

        // Obtener la categoria del usuario
        $todasCategorias = Categoria::all();
        $userCategoria = Categoria::find($user->id_categoria);

        // Obtener el equipo del usuario
        $userTeam = Team::find($user->id_escuela);

        // Obtener las competencias y categorias asociadas
        $competencia_categoria = DB::table('competencia_categoria')
            ->select('id_competencia', 'id_categoria')->get();

        // Obtener la competencia actual
        $competencia = Competencia::find($competencia_categoria[0]->id_competencia);

        // Obtener las categorias asociadas a las competencias
        foreach ($competencia_categoria as $clave => $valorId) {
            foreach (Categoria::all() as $categoria => $valor) {
                if ($valor->id == $valorId->id_categoria) {
                    $categorias[] = Categoria::find($valorId->id_categoria);
                }
            }
        }
        return view('/competidores/inscripcion', compact('competencia', 'categorias', 'userTeam', 'userCategoria', 'user', 'teams', 'todasCategorias'));
    }

    public function inscribir(Request $request, Competidor $competidor)
    {
        $user = Auth::user();
        $userCategoria = Categoria::find($user->id_categoria);
        $userTeam = Team::find($user->id_escuela);
        dd($user);
    }

    public function actualizarEscuela(Request $request)
    {
        $user = Auth::user();
        // Obtener los valores del formulario
        $usuarioId = $user->id;
        $informacionActual = $request->input('informacion_actual');
        $informacionNueva = $request->input('informacion_nueva');
        $descripcion = 'Cambio de escuela';
        // Crear un array con los datos a devolver

        // Verificar si el usuario ya tiene una solicitud de actualización de colegio activa
        $solicitudExistente = SolicitudActualizacion::where('usuario_id', $user->id)
            ->where('aprobada', '0')
            ->first();

        if ($solicitudExistente) {
            // Si el usuario ya tiene una solicitud activa, devolver un mensaje de error
            return response()->json(['error' => 'Ya tienes una solicitud de actualización de colegio pendiente'], 422);
        }

        // Crear una nueva instancia del modelo SolicitudActualizacion
        $solicitud = new SolicitudActualizacion();
        $solicitud->usuario_id = $usuarioId;
        $solicitud->descripcion = $descripcion;
        $solicitud->informacion_actual = $informacionActual;
        $solicitud->informacion_nueva = $informacionNueva;

        // Intentar guardar la solicitud en la base de datos
        try {
            $solicitud->save();
        } catch (\Exception $e) {
            // Obtener el mensaje completo del error
            $errorMessage = $e->getMessage();

            // Devolver una respuesta de error con el mensaje completo del error
            return response()->json(['error' => 'Error al guardar la solicitud: ' . $errorMessage], 500);
        }

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Solicitud de actualización creada correctamente']);
    }

    // Guardamos al competidor del formulario en la bd.
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => ['required'],
            'gal' => ['required', 'unique:competidores'],
            'du' => ['required'],
            'genero' => ['required'],
            'id_colegio' => ['required'],
            'graduacion' => ['required'],
            'clasificacion' => ['required'],
            'id_categoria' => ['required'],
            'id_pais' => ['required'],
            //'fecha_nac' => ['required'],
        ]);

        Competidor::create([
            'id_user' => $request->get('id_user'),
            'gal' => $request->get('gal'),
            'du' => $request->get('du'),
            'genero' => $request->get('genero'),
            'id_colegio' => $request->get('id_colegio'),
            'graduacion' => $request->get('graduacion'),
            'clasificacion' => $request->get('clasificacion'),
            'id_categoria' => $request->get('pais'),
            'id_pais' => $request->get('pais'),
            // 'fecha_nac' => $request->get('fecha_nac'),
        ]);

        return to_route('competidores.index')->with('success', 'El competidor se creo correctamente');
    }

    // Mostramos el formulario de edicion.
    public function edit(Competidor $competidor)
    {
        return view('competidores.edit', ['competidor' => $competidor]);
    }

    // Actualizamos el elemento en la bd.
    public function update(Request $request, Competidor $competidor)
    {
        $request->validate([
            'id_user' => ['required'],
            'gal' => ['required', 'unique:competidores'],
            'du' => ['required'],
            'genero' => ['required'],
            'id_colegio' => ['required'],
            'graduacion' => ['required'],
            'clasificacion' => ['required'],
            'id_categoria' => ['required'],
            'id_pais' => ['required'],
            //'fecha_nac' => ['required'],
        ]);

        $competidor->update([
            'id_user' => $request->get('id_user'),
            'gal' => $request->get('gal'),
            'du' => $request->get('du'),
            'genero' => $request->get('genero'),
            'id_colegio' => $request->get('id_colegio'),
            'graduacion' => $request->get('graduacion'),
            'clasificacion' => $request->get('clasificacion'),
            'id_categoria' => $request->get('pais'),
            'id_pais' => $request->get('pais'),
            // 'fecha_nac' => $request->get('fecha_nac'),
        ]);

        return to_route('competidores.show', $competidor)->with('success', 'El competidor se actualizo correctamente.');
    }

    // Eliminar competidor de la bd.
    public function destroy(Competidor $competidor)
    {
        $competidor->delete();
        return to_route('competidores.index')->with('success', 'Competidor eliminado correctamente.');
    }


    // Metodos personalizados.

    public function imprimirDatos()
    {
        $competidores = Competidor::all();
        return $competidores;
    }
}
