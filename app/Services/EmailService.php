<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

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
    }
}
