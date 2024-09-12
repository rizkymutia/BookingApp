<?php
// App\Http\Controllers\UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

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
        $selectedRoom = 'ruang1'; // Ganti dengan nilai yang sesuai jika diperlukan
        return view('home', compact('selectedRoom'));
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ruang' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        UserData::create([
            'name' => $request->input('name'),
            'ruang' => $request->input('ruang'),
            'tanggal' => $request->input('tanggal'),
        ]);

        // Tambahkan return setelah penyimpanan data
        return redirect()->route('home')->with('status', 'Data stored successfully.');
    }

    public function submitForm(Request $request)
    {
        // Validasi data form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ruang' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Mengirim email konfirmasi
        Mail::to('user@gmail.com')->send(new BookingConfirmation($validatedData));

        return redirect()->route('home')->with('status', 'Form submitted successfully! A confirmation email has been sent.');
    }
}
