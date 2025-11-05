<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;   // ✅ add this line
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function booking()
    {
        return view('admin.booking');
    }

    public function doctors()
    {
        return view('admin.doctors');
    }

    public function manageUsers()
    {
        return view('admin.manage-users');
    }

    public function reminders()
    {
        return view('admin.reminders');
    }

    public function schedule()
    {
        return view('admin.schedule');
    }

    public function records()
    {
        return view('admin.records');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
