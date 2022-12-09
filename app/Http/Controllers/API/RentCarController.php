<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class RentCarController extends ApiController
{
    /**
     * Get all rented cars
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Car::all()->where('is_busy', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Collection|JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $car = Car::all()->find($id);

        if (!$car) return response()->json(['status' => 404, 'message' => 'Car not found'], 404);

        $data = $request->input();
        $user = User::all()->find($data['user_id']);

        if (!$user) return response()->json(['status' => 404, 'message' => 'User not found'], 404);

        return $user;
    }
}
