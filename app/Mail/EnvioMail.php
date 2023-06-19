<?php

namespace App\Mail;

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

    public $nombre, $apellido, $email, $du, $escuela, $rol, $motivo;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $motivo)
    {
       $this->tipoMail($user,$motivo);
    }

    private function tipoMail($id, $tipo)
    {
        $user = User::find($id);
        switch ($tipo) {
            case '1': // se acepta el usuario
                $this->motivo = 'usuario_aceptado';
                $this->nombre = $user['nombre'];
                $this->apellido = $user['apellido'];
                $this->rol = $user['rol'];
                break;
            case '2': // se rechaza el usuario
                $this->motivo = 'usuario_rechazado';
                $this->nombre = $user['nombre'];
                $this->apellido = $user['apellido'];
                $this->rol = $user['rol'];
                break;
            case '3': // se acepta la incripcion a una competencia
                $this->motivo = 'aceptacion_inscripcion';
                $this->nombre = $user['nombre'];
                $this->apellido = $user['apellido'];
                $this->rol = $user['rol'];

                break;
            case '4': // se rechaza la inscripcion a una competencia
                $this->motivo = 'rechazo_inscripcion';
                $this->nombre = $user['nombre'];
                $this->apellido = $user['apellido'];
                $this->rol = $user['rol'];

                break;
            case '5': // se le notifica al competidor los poomsae que tiene que realizar
                $competencia = CompetenciaCompetidor::all();
                dd($competencia);
                break;

            default:
                # code...
                break;
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
