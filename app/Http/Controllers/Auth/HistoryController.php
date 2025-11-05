<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBooking;

class HistoryController extends Controller
{
    public function index()
    {
        // Get all bookings ordered by creation date
        $bookings = UserBooking::orderBy('created_at', 'desc')->get();
        return view('user.history', compact('bookings'));
    }
}