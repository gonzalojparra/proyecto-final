<?php

namespace App\Mail;

use App\Models\Competencia;
use App\Models\CompetenciaCompetidor;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;

class EnvioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre, $apellido, $email, $du, $escuela, $rol, $motivo, $nombreCompetencia;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $motivo, $idCompetencia = null)
    {
        $this->tipoMail($user, $motivo, $idCompetencia);
    }

    private function tipoMail($id, $tipo, $idCompetencia)
    {
        $user = User::find($id);
        $this->nombreCompetencia = (!is_null($idCompetencia)) ? Competencia::where('id',$idCompetencia)->pluck('titulo')[0] : "";
        switch ($tipo) {
            case '1': // se acepta el usuario
                $this->motivo = 'usuario_aceptado';
                break;
            case '2': // se rechaza el usuario
                $this->motivo = 'usuario_rechazado';
                break;
            case '3': // se acepta la incripcion a una competencia
                $this->motivo = 'aceptacion_inscripcion';

                break;
            case '4': // se rechaza la inscripcion a una competencia
                $this->motivo = 'rechazo_inscripcion';

                break;
            case '5': // se le notifica al competidor que se pueden visualizar los poomsae que tiene a realizar en la competencia
                $this->motivo = 'aviso_poomsae';
                break;

            default:
                # code...
                break;
        }
        $this->nombre = $user['name'];
        $this->apellido = $user['apellido'];
        if ($user['rolRequerido'] == 1) {
            $this->rol = 'Competidor';
        }else{
            $this->rol = 'Juez';
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novedades de Zen Kicks',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.' . $this->motivo,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
