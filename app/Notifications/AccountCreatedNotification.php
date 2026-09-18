<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected string $role)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $panelUrl = match ($this->role) {
            'admin'   => url('/admin/login'),
            'staff'   => url('/staff/login'),
            'teacher' => url('/teacher/login'),
            'donor'   => url('/donor/login'),
            'student' => url('/student/login'),
            default   => url('/login'),
        };

        return (new MailMessage())
            ->subject('Karibu Hope for Students Tanzania — Akaunti Yako Imetengenezwa')
            ->greeting('Habari ' . $notifiable->name . ',')
            ->line('Akaunti yako ya ' . ucfirst($this->role) . ' kwenye mfumo wa Hope for Students Tanzania (HFST-WBMS) imetengenezwa kikamilifu.')
            ->line('Barua pepe ya kuingia: ' . $notifiable->email)
            ->action('Ingia kwenye Mfumo', $panelUrl)
            ->line('Kama hukutegemea barua pepe hii, tafadhali wasiliana nasi mara moja.')
            ->salutation('Asante, Timu ya Hope for Students Tanzania');
    }
}
