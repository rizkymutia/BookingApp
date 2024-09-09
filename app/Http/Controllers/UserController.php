<?php 
// App\Http\Controllers\UserController.php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UserController extends Controller {
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
        return redirect()->route('users.dashboard');
    } else {
        return redirect()->back()->withErrors(['Invalid email or password']);
    }
}
}

