<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->inExceptArray($request))
            return $next($request);

        if (!$token = $this->auth->setRequest($request)->getToken()) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided',
                'error_code' => 0,
                'data' => [],
            ], 400);
        }

        try {
            $user = $this->auth->parseToken()->authenticate();

            auth()->login($user);
        } catch (TokenBlacklistedException|TokenInvalidException|TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'error_code' => null,
                'data' => config('app.debug') ? $e->getTrace() : (object)[],
                'message' => $e->getMessage(),
            ], 401);
        } catch (Exception $e) {
            return response()->json($responses = [
                'success' => false,
                'error_code' => null,
                'data' => config('app.debug') ? $e->getTrace() : (object)[],
                'message' => $e->getMessage(),
            ], 500);
        }
        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
