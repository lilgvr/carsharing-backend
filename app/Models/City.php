<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $table = 'cities';
}
