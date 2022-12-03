<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
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

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
