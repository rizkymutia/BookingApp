<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingAccepted extends Notification
{
    use Queueable;

    private $bookingDetails;

    /**
     * Create a new notification instance.
     */
    public function __construct($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * 
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pemesanan anda telah disetujui.')
            ->line('Detail pemesanan anda: ')
            ->line('Nama : ' . $this->bookingDetails['name'])
            ->line('Ruangan : ' . $this->bookingDetails['ruang'])
            ->line('Kegiatan : ' . $this->bookingDetails['kegiatan'])
            ->line('Tanggal : ' . $this->bookingDetails['tanggal'])
            ->line('Jam Mulai : ' . $this->bookingDetails['jam_mulai'])
            ->line('Jam Selesai : ' . $this->bookingDetails['jam_selesai'])
            ->line('Terima Kasih!');
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
