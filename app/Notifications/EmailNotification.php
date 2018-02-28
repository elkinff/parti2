<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailNotification extends Notification{
    use Queueable;

    public function __construct($imagen, $titulo, $descripcion, $labelButton, $url, $subject){
        $this->imagen = $imagen;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->labelButton = $labelButton;
        $this->url = $url;
        $this->subject = $subject;
    }

    public function via($notifiable){
        return ['mail'];
    }

    public function toMail($notifiable){
        $imagen = $this->imagen;
        $titulo = $this->titulo;
        $descripcion = $this->descripcion;
        $labelButton = $this->labelButton;
        $url = $this->url;

        return (new MailMessage)
            ->subject($this->subject)
            ->view("emails.email", compact("imagen", "titulo", "descripcion", "labelButton", "url"));
    }

    public function toArray($notifiable){
        return [
            //
        ];
    }
}
