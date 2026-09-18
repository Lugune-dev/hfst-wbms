<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDonationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Donation $donation)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $donorName = $this->donation->donor?->user?->name ?? 'Unknown Donor';

        return (new MailMessage())
            ->subject('Mchango Mpya Umepokelewa — TZS ' . number_format((float) $this->donation->amount, 0))
            ->greeting('Habari,')
            ->line('Mchango mpya umetumwa na unasubiri uthibitisho.')
            ->line('Mfadhili: ' . $donorName)
            ->line('Kiasi: TZS ' . number_format((float) $this->donation->amount, 0))
            ->line('Njia ya Malipo: ' . ($this->donation->payment_method ?? 'N/A'))
            ->action('Thibitisha Mchango', url('/admin/donations'))
            ->salutation('HFST-WBMS');
    }
}
