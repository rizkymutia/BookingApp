<?php
// App\Http\Controllers\UserController.php
namespace App\Http\Controllers;


use App\Models\UserData;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with('message', 'Login successful');
        } else {
            return redirect()->back()->withErrors(['Invalid email or password']);
        }
    }

    public function dashboard()
    {
        return view('home');
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ruang' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);
       
        $tanggal = $request->input('tanggal');
        $jamMulai = $request->input('jam_mulai');
        $jamSelesai = $request->input('jam_selesai');

        $exists = Appointment::where('tanggal', $tanggal)
                              ->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
                              ->exists();

        if ($exists) {
            return back()->with('error', 'Jadwal pada tanggal dan jam ini sudah dipilih.');
        }

        UserData::create([
            'name' => $request->input('name'),
            'ruang' => $request->input('ruang'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'tanggal' => $request->input('tanggal'),
        ]);

        Appointment::create([
            'tanggal' => $tanggal,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'name' => $request->input('name'),
            'ruang' => $request->input('ruang'),
        ]);

        // Tambahkan return setelah penyimpanan data
        return redirect()->route('home')->with('success', 'Jadwal berhasil disimpan.');
    }

    public function checkAvailability(Request $request)
    {
    $exists = Appointment::where('tanggal', $request->input('tanggal'))
                          ->where('jam_mulai', $request->input('jam_mulai'))
                          ->exists();

    return response()->json(['exists' => $exists]);
    }



}