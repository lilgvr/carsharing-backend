<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends ApiBaseModel
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $table = 'colors';
}
