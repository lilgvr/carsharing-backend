<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'brand',
        'type_id',
        'color_id',
        'production_year',
        'lat',
        'lng',
        'mileage',
        'is_busy',
        'tariff_id'
    ];

    protected $table = 'cars';
}
