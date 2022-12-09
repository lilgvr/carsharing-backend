<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserController extends ApiController
{
    /**
     * Get all users
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return User::all();
    }
}
