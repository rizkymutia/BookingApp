<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Deklarasikan variabel untuk menyimpan data

    /**
     * Create a new message instance.
     */
    public function __construct($data) // Terima $data sebagai parameter
    {
        $this->data = $data; // Inisialisasi data
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view('email.booking_confirmation') // Ganti dengan nama view yang sesuai
                    ->with('data', $this->data); // Kirim data ke view
    }
}
