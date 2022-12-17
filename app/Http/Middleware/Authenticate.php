<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Config;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $key = Config::get('values.key');
        $alg = Config::get('values.alg');

        if (!$request->header('Authorization'))
            return response()->json(['status' => 401, 'message' => 'Unauthorized token'], 401);

        if ($token = explode(" ", $request->header('Authorization'))) {
            $email = JWT::decode($token[1], new Key($key, $alg));

            $user = User::all()->where('email', $email->{'0'})->first();

            if (is_null($user)) {
                return response()->json(['status' => 401, 'message' => 'Unauthorized token'], 401);
            }
        }

        return $next($request);
    }

    private function objectToArray($data): array
    {
        $array = (array)$data;
        foreach ($array as $key => &$field) {
            if (is_object($field)) $field = $this->objectToarray($field);
        }
        return $array;
    }
}
