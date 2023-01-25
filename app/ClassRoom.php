<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'days', 'capacity', 'start_time', 'end_time'
    ];

    protected $casts = [
        'days' => 'array'
    ];

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
