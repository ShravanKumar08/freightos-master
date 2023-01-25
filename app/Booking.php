<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'class_room_id', 'user_id', 'date', 'start_time', 'end_time', 'cancelled'
    ];

    public function class_room()
    {
        return $this->belongsTo('App\ClassRoom');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
