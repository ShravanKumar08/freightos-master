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
        'id', 'name', 'days',
    ];

    protected $casts = [
        'days' => 'array'
    ];
}
