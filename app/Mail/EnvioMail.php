<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnvioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre, $apellido, $email, $du, $escuela, $rol, $motivo;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $motivo)
    {
        $user = User::find($user);
        $this->motivo = $motivo;
        $this->rol = $user->roles()->pluck('name')[0];
        $this->nombre = $user['name'];
        $this->apellido = $user['apellido'];
        $this->email = $user['email'];
        $this->du = (isset($user['du'])?$user['du'] : "");        
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
            view: 'emails.'.$this->motivo,
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
