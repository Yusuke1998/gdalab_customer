<?php

namespace App\Http\Middleware;

use Closure;

class CheckJsonIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        try {
            $content = $request->getContent();
            if ($content) {
                json_decode($content, false, 512, JSON_THROW_ON_ERROR);
            }
        } catch (\JsonException $exception) {
            throw new \Exception("Bad JSON syntax received.");
        }

        return $next($request);
    }
}
