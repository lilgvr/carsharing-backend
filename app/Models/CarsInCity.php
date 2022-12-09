<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarsInCity extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'car_id'
    ];

    protected $table = 'cars_in_cities';
}
