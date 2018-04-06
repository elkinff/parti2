<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordOwn extends Notification{
    use Queueable;

    public $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function via($notifiable){
        return ['mail'];
    }

    public function toMail($notifiable){
        $imagen = "recuperacion";
        $titulo = "Recupera tu contraseña de parti2";
        $descripcion = "Recibes este correo electrónico porque fuimos notificados de una solicitud de restablecimiento de contraseña para tu cuenta.";
        $labelButton = "Cambia tu contraseña";
        $url = url(config('app.url').route('password.reset', $this->token, false));

        return (new MailMessage)
            ->subject("Cambia tu contraseña de parti2")
            ->view("emails.email", compact("imagen", "titulo", "descripcion", "labelButton", "url"));
    }
}
