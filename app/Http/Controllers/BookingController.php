<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BookingController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function confirmBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User tidak dikenali'], 401);
        }

        $email = $user->email;
        $bookingDetails = session('booking_details');

        if (!$bookingDetails) {
            $validated = $request->validate([
                'booking_details' => 'required|string'
            ]);

            $bookingDetails = $validated['booking_details'];
        }

        try {
            $this->emailService->sendBookingNotification($email, $bookingDetails);
            return response()->json(['success' => 'Email konfirmasi terkirim']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Email gagal dikirim: ' . $e->getMessage()], 500);
        }
    }
}
