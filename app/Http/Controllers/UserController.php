<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    /*public function store(Request $request): JsonResponse
    {
        $user = new User();

        $data = $request->input();

        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];

        $user->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $user]);
    }*/

    /**
     * @param int $id
     * @return User|JsonResponse
     */
    public function show(int $id): User|JsonResponse
    {
        $user = User::all()->find($id);
        if (!$user) return response()->json(['message' => 'Not found', 'status' => 404], 404);
        return $user;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->input();
        $user = User::all()->find($id);

        if (!$user) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];

        $user->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $user]);
    }
}
