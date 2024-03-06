<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Reservation\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function bookings(){
        $bookings = Reservation::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('users.bookings', compact('bookings'));
    }
}
