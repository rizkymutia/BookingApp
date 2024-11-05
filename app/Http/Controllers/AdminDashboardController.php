<?php

// App\Http\Controllers\AdminDashboardController.php

namespace App\Http\Controllers;


use App\Models\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\BookingAcceptedMail;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class AdminDashboardController extends Controller
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        $userData = UserData::all();
        return view('admin.dashboard', compact('userData'));
    }

    public function edit($id)
    {
        $userData = UserData::where('user_id', $id)->first();

        if (!$userData) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        return view('admin.edit', compact('userData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'ruang' => 'required|string',
            'kegiatan' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'tanggal' => 'required|date',
        ]);

        $userData = UserData::where('user_id', $id)->first();

        $userData->update($request->only(['name', 'email', 'ruang', 'jam_mulai', 'jam_selesai', 'tanggal']));

        return redirect()->route('admin.dashboard')->with('success', 'User data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $userData = UserData::find($id);
        if (!$userData) {
            // Jika user tidak ditemukan, redirect dengan pesan error
            return redirect()->route('admin.dashboard')->with('error', 'User data tidak ditemukan.');
        }

        // Jika user ditemukan, hapus data
        $userData->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User data berhasil dihapus.');
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array|min:1',
        ]);

        $ids = $request->input('selected_ids');

        if ($ids) {
            // Lakukan penghapusan untuk ID yang dipilih
            UserData::whereIn('user_id', $ids)->delete();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data deleted successfully');
    }
}
