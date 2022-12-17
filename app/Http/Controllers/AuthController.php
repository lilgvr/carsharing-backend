<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCredentials;
use DateTimeImmutable;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Config;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        parent::__construct();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $key = Config::get('values.key');
        $alg = Config::get('values.alg');

        $data = $request->input();

        $now = new DateTimeImmutable();
        $iat = $now->getTimestamp();
        $exp = $now->modify('+30 minutes')->getTimestamp();

        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'email' => $data["email"],
        ];

        $token = JWT::encode($payload, $key, $alg);

        $user = User::all()->where('email', $data["email"])->first();

        $credentials = UserCredentials::all()->where('email', $data["email"])->first();

        if (!password_verify($data["password"], $credentials["password"])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user->api_token = $token;
        $user->save();

        return response()->json([
            'access_token' => [
                'value' => $token,
                'iat' => $iat,
                'exp' => $exp,
                'token_type' => 'bearer',
                'expires_in' => 30 * 3600
            ],
            'data' => $user
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
