<?php

namespace App\Http\Requests;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CancellationRequest extends FormRequest
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
        $data['booking_id'] = [function ($attribute, $value, $fail) use ($request) {

            $booking = Booking::find($request->booking_id);
            $subDay = Carbon::parse($booking->date.' '.$booking->start_date)->subday();

            if (Carbon::now() > $subDay) {
                $fail("You can't cancell the class.");
            }
        }];
    }
}
