<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|Closure
     */
    public function handle(Request $request, Closure $next): JsonResponse|Closure
    {
        $role = $request->header('Role');

        if ($role == 'admin') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Unauthorized', 'status' => 401], 401);
        }
    }
}
