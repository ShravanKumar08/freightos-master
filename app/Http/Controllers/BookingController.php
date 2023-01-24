<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index()
    {

    }

    public function store(BookingRequest $request)
    {
        $booking =  new Booking();
        $booking->fill($request->all());
        $booking->save();

        return $this->respondSuccess("Booked Successfully..!!!");
    }
}
