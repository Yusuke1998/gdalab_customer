<?php

namespace App\Http\Middleware;

use App\Events\Auth\TokenAuthenticated;
use App\Models\Token;
use App\Models\TokenStatistic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        $token = Token::where('api_token', $bearerToken)->first();
        $response = $next($request);
        $responseData = $response->getContent();

        if (!is_null($token)) {
            event(new TokenAuthenticated($request->ip(), $token, [
                    'parameters' => $request->request->all(),
                    'headers' => [
                        'user-agent' => $request->userAgent(),
                    ],
                ], env('APP_ENV') == "production" ? null : json_decode($responseData)
            ));
        }

        return $response;
    }
}
