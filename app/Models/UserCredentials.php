<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredentials extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'api_token'
    ];
}
