<?php

namespace App\Http\Requests;

use App\Booking;
use App\ClassRoom;
use App\Holiday;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $time = Carbon::parse($request->date.' '. $request->start_time)->format('H:i A');
        $classRoom = ClassRoom::find($request->class_room_id);

        $data['date'] = [function ($attribute, $value, $fail) use ($request) {
            $holiday = Holiday::where('date', $request->date)
                ->where('class_room_id', $request->class_room_id)
                ->first();

            if ($holiday) {
                return $fail('You have choosed holiday date. Please choose different date');
            }

        }];
        $data['start_time'] = [function ($attribute, $value, $fail) use ($request, $time, $classRoom)
        {
            // Chech this time allocate of same class or any other classes
            
            for($i=1; $i<=$request->hours; $i++) {
                $bookings = Booking::where('date', $request->date)
                    ->where('cancelled', 0)
                    ->where('start_time', '>=', $time)
                    ->where('end_time', '>=', $time);

                $userBookingCheck = $bookings->where('user_id', $request->user_id)->count();
                $BookingCount = $bookings->count();

                if ($userBookingCheck) { 
                    return $fail('Your timing allocated to same or other class. Please choose different timings');
                }

                if ($BookingCount == $classRoom->capacity) { 
                    return $fail('Class Room is full. Please choose different timings');
                }

                $time = Carbon::parse($request->date.' '. $request->start_time)->addHour()->format('H:i A');
            }

        }];
    }
}
