<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingRejected;
use Illuminate\Support\Facades\Notification;



class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
    // App\Http\Controllers\AdminController.php

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the admin
        if ($request->username === 'admin' && $request->password === 'admin') {
            // If the credentials match, log the admin in
            auth()->guard('web')->loginUsingId(1); // Assuming the admin user has an ID of 1
            return redirect()->route('admin.dashboard');
        } else {
            // If the credentials don't match, redirect back to the login page with an error message
            return redirect()->back()->withErrors(['Invalid username or password']);
        }
    }

    public function dashboard()
    {
        // You can add any logic here to display data on the dashboard
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function acceptBooking($user_id, Request $request)
    {
        $data = UserData::find($user_id);
        if ($data) {
            $data->status = "diterima";
            $data->save();

            $bookingDetails = [
                'name' => $data->name,
                'ruang' => $data->ruang,
                'kegiatan' => $data->kegiatan,
                'tanggal' => $data->tanggal,
                'jam_mulai' => $data->jam_mulai,
                'jam_selesai' => $data->jam_selesai,
            ];

            Notification::route('mail', $data->email)->notify(new BookingAccepted($bookingDetails));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }

    public function rejectBooking($user_id, Request $request)
    {
        $data = UserData::find($user_id);
        if ($data) {
            $data->status = "ditolak";
            $data->save();

            $bookingDetails = [
                'name' => $data->name,
                'ruang' => $data->ruang,
                'kegiatan' => $data->kegiatan,
                'tanggal' => $data->tanggal,
                'jam_mulai' => $data->jam_mulai,
                'jam_selesai' => $data->jam_selesai,
            ];

            Notification::route('mail', $data->email)->notify(new BookingRejected($bookingDetails));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }
}
