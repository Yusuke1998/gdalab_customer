<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiToken = $request->get('apiToken', null);
        $confKey = env('API_TOKEN', 'yusuke1998');

        if (!$apiToken || $apiToken != $confKey) {
            return response()->json([
                'success' => false,
                'message' => 'invalid_apiToken'
            ], 401);
        }

        return $next($request);
    }
}
