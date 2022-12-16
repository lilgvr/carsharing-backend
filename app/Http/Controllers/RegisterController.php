<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->input();

        $ifExist = User::all()->where('email', $data["email"]);

        if ($ifExist->count() != 0)
            return response()->json(['message' => 'Already registered', 'status' => 401], 401);

        $user = new User();

        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = password_hash($data["password"], PASSWORD_DEFAULT);
        $user->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $user]);
    }
}
