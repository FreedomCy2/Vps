<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function index()
    {
        $bookings = UserHistory::where('user_id', Auth::id())->get();
        return view('user.history', compact('bookings'));
    }

    public function show($id)
    {
        $booking = UserHistory::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->first();

        return view('user.edit', compact('booking'));
    }
}
