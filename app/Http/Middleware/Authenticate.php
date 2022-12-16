<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Config;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $key = Config::get('values.key');
        $alg = Config::get('values.alg');

        if (!$request->header('Authorization'))
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);

        if ($token = explode(" ", $request->header('Authorization'))) {
            $email = json_decode(json_encode(JWT::decode($token[1], new Key($key, $alg))), true);

            $user = User::all()->where('email', $email[0])->first();

            if (is_null($user)) {
                return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
            }

            return $next($request);
        }

        return $next($request);
    }
}
