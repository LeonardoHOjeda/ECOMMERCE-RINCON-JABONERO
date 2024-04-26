<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification
{
    use Queueable;


    public function __construct()
    {

    }

    public function via(object $user): array
    {
        return ['mail'];
    }

    public function toMail(User $user): MailMessage
    {
      $greeting = $user->name ? 'Hola, ' . $user->name : 'Hola!';
        return (new MailMessage)
          ->subject('Confirma tu correo electrónico')
          ->greeting($greeting)
          ->line('Por favor, haz clic en el botón de abajo para confirmar tu correo electrónico.')
          ->action('Confirmar correo electrónico', url('/email/verify/' . $user->email_verification_token))
          ->salutation('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $user): array
    {
        return [
            //
        ];
    }
}
