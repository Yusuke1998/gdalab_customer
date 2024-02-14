<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VerifyCustomerField
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
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|unique:App\Models\Customer,dni',
            'email' => 'required|email|unique:App\Models\Customer,email',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'id_reg' => [
                'required',
                'string',
                Rule::exists('regions', 'id_reg')->where(function ($query) use ($request) {
                    $query->where('id_reg', $request->id_reg);
                }),
            ],
            'id_com' => [
                'required',
                'string',
                Rule::exists('communes', 'id_com')->where(function ($query) use ($request) {
                    $query->where('id_com', $request->id_com)
                        ->where('id_reg', $request->id_reg);
                }),
            ],
            'address' => 'string'
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    "success" => false,
                    "data" => [],
                    "errors" => $validator->messages()
                ], 422);
        }
        return $next($request);
    }
}
