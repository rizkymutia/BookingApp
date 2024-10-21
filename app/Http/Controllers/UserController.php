<?php
// App\Http\Controllers\UserController.php
namespace App\Http\Controllers;


use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function showForm()
    {

        return view('home');
    }
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nomor' => 'required|string',
            'ruang' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        session()->flash('confirmData', $validatedData);
        return redirect()->route('confirm.result');
    }

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
            'nomor' => 'required|string',
            'ruang' => 'required|string',
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

        UserData::create([
            'name' => $request->input('name'),
            'nomor' => $request->input('nomor'),
            'ruang' => $request->input('ruang'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'tanggal' => $request->input('tanggal'),
        ]);


        // Tambahkan return setelah penyimpanan data
        return redirect()->route('home')->with('message', 'Data berhasil ditambahkan');
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

        if (!$data) {
            return redirect()->route('home')->with('error', 'No data available.');
        }

        return view('confirm', [
            'name' => $data['name'] ?? null,
            'nomor' => $data['nomor'] ?? null,
            'ruang' => $data['ruang'] ?? null,
            'jam_mulai' => $data['jam_mulai'] ?? null,
            'jam_selesai' => $data['jam_selesai'] ?? null,
            'tanggal' => $data['tanggal'] ?? null,
        ]);
    }
}
