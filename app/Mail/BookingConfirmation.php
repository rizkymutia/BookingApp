<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails; // Deklarasikan variabel untuk menyimpan data

    /**
     * Create a new message instance.
     * @param array $bookingDetails
     * @return void
     */
    public function __construct($bookingDetails) // Terima $data sebagai parameter
    {
        $this->bookingDetails = $bookingDetails; // Inisialisasi data
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pemesanan Ruangan')
            ->view('emails.booking');
    }
}
