<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewProfile()
    {
        $userid = auth()->user()->id;
        // $user = User::find($userid);
        $user = User::with('employeeExtDetail')->find($userid);
        return view('backend.profile.view', compact('user'));
    }

    public function editProfile()
    {
        return view('backend.profile.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        return redirect()->route('viewProfile')->with('success', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('backend.profile.change_password');
    }

    public function updatePassword(Request $request)
    {
        return redirect()->route('viewProfile')->with('success', 'Password updated successfully');
    }
}
