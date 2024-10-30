<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class EmailService
{
    /**
     * Summary of sendBookingNotification
     * @param string $email
     * @param array $bookingDetails
     * @throws \Exception
     * @return void
     */
    public function sendBookingNotification($email, $bookingDetails)
    {
        try {
            Mail::to($email)->send(new BookingConfirmation($bookingDetails));
        } catch (\Exception $e) {
            throw new \Exception('Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
