<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
<<<<<<< HEAD
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
=======

use Illuminate\Support\Facades\Log;

class EmailService
{

    public function sendBookingNotification($to, $bookingDetails)
    {
        $subject = "Pemesanan ruangan telah dikonfirmasi";

        Mail::send('emails.booking', ['bookingDetails' => $bookingDetails], function ($msg) use ($to, $subject) {
            $msg->to($to)
                ->subject($subject);
        });
        Log::info("Email terkirim ke: $to dengan detail: " . json_encode($bookingDetails));
>>>>>>> 2ff84be64a0372a1c4c84c09a7f956636ff1db71
    }
}
