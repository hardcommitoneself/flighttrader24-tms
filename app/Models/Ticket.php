<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'departure_time',
        'source_airport',
        'destination_airport',
        'seat',
        'passport_id',
    ];

    /**
     * The attributes that should be nullable
     * 
     * @var array
     */
    protected $nullable = [];

    /**
     * The attributes that should be cast
     * 
     * @var array
     */
    protected $casts = [
        'departure_time' => 'datetime',
        'seat' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}
