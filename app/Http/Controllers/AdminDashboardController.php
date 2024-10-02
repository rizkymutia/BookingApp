<?php

// App\Http\Controllers\AdminDashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;



class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::with('userData')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ruang' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'tanggal' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name']));

        $userData = $user->userData;

        if ($userData) {
            // Pastikan userData memiliki ID yang valid
            $userData->update($request->only(['ruang', 'jam_mulai', 'jam_selesai', 'tanggal']));
        } else {
            // Jika data user_data belum ada, buat baru
            $user->userData()->create($request->only(['ruang', 'jam_mulai', 'jam_selesai', 'tanggal']));
        }

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
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
