<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'class_room_id', 'date', 'reason'
    ];
}
