<?php
// App\Http\Controllers\UserController.php
namespace App\Http\Controllers;


use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    public function showForm()
    {

        return view('form');
    }

    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'ruang' => 'required|string',
            'kegiatan' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        session()->put('confirmData', $validatedData);
        Log::info('Confirm Data:', $validatedData);

        return redirect()->route('confirm.result');
    }

    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json(['success' => true, 'url' => '/dashboard']); // Redirect URL after successful login
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
    }

    public function dashboard()
    {
        return redirect()->route('form');
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'ruang' => 'required|string',
            'kegiatan' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        $exists = UserData::where('tanggal', $request->input('tanggal'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->input('jam_mulai'), $request->input('jam_selesai')])
                    ->orWhereBetween('jam_selesai', [$request->input('jam_mulai'), $request->input('jam_selesai')]);
            })
            ->exists();

        if ($exists) {
            return back()->with('error', 'Jadwal pada tanggal dan jam ini sudah dipilih.');
        }

        $userData = UserData::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'ruang' => $request->input('ruang'),
            'kegiatan' => $request->input('kegiatan'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'tanggal' => $request->input('tanggal'),
        ]);

        $bookingDetails = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'ruang' => $request->input('ruang'),
            'kegiatan' => $request->input('kegiatan'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'tanggal' => $request->input('tanggal'),
        ];
        // Tambahkan return setelah penyimpanan data
        $bookingDetails = $request->only(['name', 'email', 'ruang', 'jam_mulai', 'jam_selesai', 'tanggal']);
        session(['booking_details' => $bookingDetails]);

        return redirect()->route('booking.confirmBooking');
    }
    public function checkAvailability(Request $request)
    {
        $exists = UserData::where('tanggal', $request->input('tanggal'))
            ->where('jam_mulai', $request->input('jam_mulai'))
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function showResult()
    {
        $data = session('confirmData');

        // Periksa apakah $data ada dan memiliki 'name'
        if (!$data || !isset($data['name'])) {
            Log::error('Session confirmData not available or missing required fields');

            return redirect()->route('form')->with('error', 'No data available.');
        }

        // Akses data dengan aman
        $userData = UserData::where('name', $data['name'])->first();

        // Simpan data ke database setelah konfirmasi
        UserData::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'ruang' => $data['ruang'],
            'kegiatan' => $data['kegiatan'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'tanggal' => $data['tanggal'],
        ]);

        return view('confirm', [
            'name' => $data['name'],
            'email' => $data['email'],
            'ruang' => $data['ruang'],
            'kegiatan' => $data['kegiatan'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'tanggal' => $data['tanggal'],
            'userData' => $userData,
        ]);
    }
}
