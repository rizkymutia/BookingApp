<?php

// App\Http\Controllers\AdminDashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $data = UserData::all();
        return view('admin.dashboard', compact('users', 'data'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            // Jika user tidak ditemukan, redirect dengan pesan error
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        // Jika user ditemukan, hapus data
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
