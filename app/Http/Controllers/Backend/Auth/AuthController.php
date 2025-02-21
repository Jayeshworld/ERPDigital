<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function postLogin(Request $request)
    {
        // Validate login input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Get login credentials
        $credentials = [
            'loginId' => $request->email, // Change to 'email' if needed
            'password' => $request->password,
        ];
        Log::info(print_r($credentials, true));
        // Check if 'remember me' is checked
        $remember = $request->has('remember');

        // Attempt authentication
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session

            $request->session()->regenerate();

            // Redirect to dashboard with success message
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }
        Log::info("Failed Auth");

        // Authentication failed, return back with an error message
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
