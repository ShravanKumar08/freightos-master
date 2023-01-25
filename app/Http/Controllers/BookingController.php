<?php

namespace App\Http\Controllers;

use App\Booking;
use App\ClassRoom;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\CancellationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $classRoom = ClassRoom::find($request->class_room_id);
        $data['class_room_id'] = $request->class_room_id;
        $data['class_room_name'] = $classRoom->name;
        $data['date'] = $request->date;
        $time = $classRoom->start_time;
    
        while($time <= $classRoom->end_time) {
            $bookingCount = Booking::where('date', $request->date)
                ->where('cancelled', 0)
                ->where('start_time', '<=', $time)
                ->where('end_time', '>=', $time)
                ->count();
            
            $data['time'][] = [
                'time' => $time,
                'count' => $bookingCount
            ];

            $time = Carbon::parse($request->date.' '. $time)->addHour()->format('H:i:s');
        }

        return $data;
    }

    public function store(BookingRequest $request)
    {
        $booking =  new Booking();
        $booking->fill($request->all());
        $booking->date = Carbon::parse($request->date);
        $hours = $request->hours + 1;
        $endTime = Carbon::parse($request->date.' '. $request->start_time)->addHour($hours)->format('H:i:s');
        $booking->end_time = $endTime;
        $booking->save();

        return "Booked Successfully..!!!";
    }

    /**
     * 
     */
    public function options(Request $request)
    {
        $data = [];
        if ($request->date) {

            $day = Carbon::parse($request->date)->dayOfWeek;
            $classRooms = ClassRoom::whereJsonContains('days', $day)->get();

            foreach($classRooms as $classRoom) {
                $data['class_rooms'][] = [
                    'id' => $classRoom->id,
                    'name' => $classRoom->name
                ];
            }
        }

        return $data;
    }

    /**
     * 
     */
    public function cancellation(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $booking->cancelled = 1;
        $booking->save();

        return('Your Booking have been cancelled');
    }
}
