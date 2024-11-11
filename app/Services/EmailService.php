<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\BookingAcceptedMail;
use App\mail\BookingRejectedMail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Summary of sendBookingNotification
     * @param string $email
     * @param array $bookingDetails
     * @throws \Exception
     * @return void
     */

    public function sendBookingAcceptedConfirmation($email, $bookingDetails)
    {
        Log::info('Mengirim email ke:', ['email' => $email]);
        try {
            Mail::to($email)->send(new BookingAcceptedMail($bookingDetails));
        } catch (\Exception $e) {
            throw new \Exception('Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function sendBookingRejectedConfirmation($email, $bookingDetails)
    {
        Log::info('Mengirim email ke:', ['email' => $email]);
        try {
            Mail::to($email)->send(new BookingRejectedMail($bookingDetails));
        } catch (\Exception $e) {
            throw new \Exception('Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
