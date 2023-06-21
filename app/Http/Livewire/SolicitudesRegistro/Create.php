<?php

namespace App\Http\Livewire\SolicitudesRegistro;

use App\Mail\EnvioMail;
use App\Models\Graduacion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Create extends Component
{

    public $open = false;
    public $iduser, $nombre, $apellido, $email, $fecha_nac, $gal, $du, $clasificacion, $graduacion, $genero, $verificado, $escuela;

    protected $listeners = ['openModal' => 'mostrarUsuario'];

    public function mostrarUsuario($user)
    {
        
        $this->iduser = $user['id'];
        $this->nombre = $user['name'];
        $this->apellido = $user['apellido'];
        $this->email = $user['email'];
        $this->fecha_nac = $user['fecha_nac'];
        $this->gal = $user['gal'];
        $this->du = $user['du'];
        $this->clasificacion = $user['clasificacion'];

        if ($user['id_graduacion'] !== null) {
            $queryGrad = Graduacion::where('id', $user['id_graduacion'])->get();
            $graduacionArray = $queryGrad->toArray();
            $graduacion = $graduacionArray[0]['nombre'];
        } else {
            $graduacion = '';
        }

        $this->graduacion = $graduacion;
        $this->genero = $user['genero'];
        $this->verificado = $user['verificado'];
        $this->escuela = $user['escuela'];

        $this->open = true;
    }


    public function render()
    {
        return view('livewire.solicitudes-registro.create');
    }

    public function aceptarSolicitud($user)
    {
        $usuario = User::find($user);
        if ($usuario !== null) {
            if ($usuario->verificado == false) {
                $usuario->verificado = true;
                if ($usuario->save()) {
                    $this->emit('render');
                    Mail::to($usuario->email)->send(new EnvioMail($this->iduser,1));
                    $this->open = false;
                }
            }
        }
    }

    public function rechazarSolicitud($user)
    {

        if (DB::table('model_has_roles')->where('model_id', '=', $user)->get()) {
            Mail::to($this->email)->send(new EnvioMail($this->iduser,2));
            DB::table('model_has_roles')->where('model_id', '=', $user)->delete();
            DB::table('users')->where('id', '=', $user)->delete();
            $this->emit('render');
            $this->open = false;
        }
    }
}
