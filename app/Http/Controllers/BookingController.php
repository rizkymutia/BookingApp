<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;
=======
>>>>>>> 2ff84be64a0372a1c4c84c09a7f956636ff1db71



class BookingController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

<<<<<<< HEAD
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

=======
>>>>>>> 2ff84be64a0372a1c4c84c09a7f956636ff1db71
    public function confirmBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User tidak dikenali'], 401);
        }

        $email = $user->email;
<<<<<<< HEAD
        $bookingDetails = $request->input('booking_details');

        if (is_string($bookingDetails)) {
            $bookingDetails = json_decode($bookingDetails, true);
        }

        $bookingDetails = $bookingDetails ?: session('booking_details');
        Log::info('Booking details retrieved from session:', ['booking_details' => $bookingDetails]);

=======
        $bookingDetails = session('booking_details');

        if (!$bookingDetails) {
            $validated = $request->validate([
                'booking_details' => 'required|string'
            ]);

            $bookingDetails = $validated['booking_details'];
        }

>>>>>>> 2ff84be64a0372a1c4c84c09a7f956636ff1db71
        try {
            $this->emailService->sendBookingNotification($email, $bookingDetails);
            return response()->json(['success' => 'Email konfirmasi terkirim']);
        } catch (\Exception $e) {
<<<<<<< HEAD
            Log::error('Gagal mengirim email: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengirim email'], 500);
=======
            return response()->json(['error' => 'Email gagal dikirim: ' . $e->getMessage()], 500);
>>>>>>> 2ff84be64a0372a1c4c84c09a7f956636ff1db71
        }
    }
}
