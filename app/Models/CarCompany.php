<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarCompany extends ApiBaseModel
{
    use HasFactory;
    protected $fillable = ['title'];
    protected $table = 'car_companies';
}
