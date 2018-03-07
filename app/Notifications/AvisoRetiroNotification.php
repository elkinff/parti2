<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AvisoRetiroNotification extends Notification{
    use Queueable;

    public function __construct($usuario, $monto){
        $this->usuario = $usuario;
        $this->monto = $monto;
    }

    public function via($notifiable){
        return ['mail'];
    }

    public function toMail($notifiable){
        return (new MailMessage)
                ->greeting("Hola Parti2 Admin!")
                ->subject("Retiro de credito en Parti2")
                ->line('Retiro de dinero para el usuario: '.$this->usuario->nombre.'. Id: '.$this->usuario->id.'. Monto: '.$this->monto.'. Celular: '.$this->usuario->celular);
    }   
}
