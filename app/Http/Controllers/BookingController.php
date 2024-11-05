<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class BookingController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function confirmBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User tidak dikenali'], 401);
        }

        $email = $user->email;
        $bookingDetails = $request->input('booking_details');

        if (is_string($bookingDetails)) {
            $bookingDetails = json_decode($bookingDetails, true);
        }

        $bookingDetails = $bookingDetails ?: session('booking_details');
        Log::info('Booking details retrieved from session:', ['booking_details' => $bookingDetails]);


        try {
            $this->emailService->sendBookingAcceptedConfirmation($email, $bookingDetails);
            return response()->json(['success' => 'Email konfirmasi terkirim']);
        } catch (\Exception $e) {

            Log::error('Gagal mengirim email: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengirim email'], 500);
        }
    }

    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User tidak dikenali'], 401);
        }

        $email = $user->email;
        $bookingDetails = $request->input('booking_details');

        if (is_string($bookingDetails)) {
            $bookingDetails = json_decode($bookingDetails, true);
        }

        $bookingDetails = $bookingDetails ?: session('booking_details');
        Log::info('Booking details retrieved from session:', ['booking_details' => $bookingDetails]);

        try {
            $this->emailService->sendBookingRejectedConfirmation($email, $bookingDetails);
            return response()->json(['success' => 'Email penolakan terkirim!']);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengirim email'], 500);
        }
    }
}
