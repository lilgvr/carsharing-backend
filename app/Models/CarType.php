<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarType extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = ["title"];

    protected $table = 'car_types';
}
