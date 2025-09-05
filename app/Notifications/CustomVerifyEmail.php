<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
        ->subject('Verifikasi Akun DSComputer Anda')
                    ->greeting('Halo, ' . $notifiable->name)
                    ->line('Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
                    ->action('Verifikasi Email', $verifyUrl)
                    ->line('Jika Anda tidak membuat akun, Anda tidak perlu melakukan tindakan apa pun.')
                    ->salutation('Hormat Kami, ' . config('app.name'))
                    ;
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
