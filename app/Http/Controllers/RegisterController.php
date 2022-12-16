<?php

namespace App\Http\Controllers;

use App\Http\Library\ApiHelpers;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ApiHelpers;

    public function show(Request $request, int $id)
    {

    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->input();

        $ifExist = User::all()->where('email', $data["email"]);

        if ($ifExist->count() != 0)
            return response()->json(['message' => 'Already registered', 'status' => 401], 401);

        $user = new User();

        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = Hash::make($data["password"]);
        $user->save();
        $token = $user->createToken($data["name"])->accessToken;
        $user->api_token = $token;
        $user->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => [$user, $token]]);
    }
}
