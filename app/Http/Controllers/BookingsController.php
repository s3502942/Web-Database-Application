<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use App\Booking;
use App\Movies;
use App\Session;

class BookingsController extends Controller
{
    public function index(Request $request)
    {

        return view('form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "sess_id" => 'required',
            "user_id" => 'required',
            "status" => 'required'
        ]);

        $booking = Booking::create($request->all());
        $session = Session::find($request->sess_id);
        $movie = Movies::find($session->mv_id);

        return view('bookings', compact('session', 'movie', 'booking'));
    }
}
