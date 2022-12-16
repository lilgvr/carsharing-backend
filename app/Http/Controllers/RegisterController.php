<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\service\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $data = $request->input();

        $user->name = $data["name"];
        $user->email = $data["name"];
        $user->password = Hash::make($data["name"]);
        $user->api_token = JwtService::encode(6, $user->name);

        $user->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $user]);
    }
}
