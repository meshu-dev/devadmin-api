<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthCookieService;

class AddAuthToken
{
    public function __construct(
        protected AuthCookieService $authCookieService
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() == null) {
            $token = $this->authCookieService->getToken($request);

            if ($token) {
                $request->headers->add([
                    'Authorization' => "Bearer $token"
                ]);
            }
        }

        return $next($request);
    }
}
