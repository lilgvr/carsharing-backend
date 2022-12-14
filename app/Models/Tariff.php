<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tariff extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cost'
    ];

    protected $table = 'tariffs';
}
