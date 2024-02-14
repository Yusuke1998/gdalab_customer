<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $records = Customer::where('status', 'A')
                ->with(['region', 'commune']);
            if ($request->get('email') || $request->get('dni')) {
                $records->where(function (Builder $query) use ($request) {
                    if ($dni = $request->get('dni')) {
                        $query->orWhere('dni', trim($dni));
                    }
                    if ($email = $request->get('email')) {
                        $query->orWhere('email', trim($email));
                    }
                });
            }
            return response()
                ->json([
                    "success" => true,
                    "data" => CustomerResource::collection($records->get())
                ], 200);
        } catch (\Exception $error) {
            return response()
                ->json([
                    "success" => false,
                    "data" => []
                ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $record = Customer::create($request->all());
            return response()
                ->json([
                    "success" => true,
                    "data" => CustomerResource::make($record)
                ], 201);
        } catch (\Exception $error) {
            return response()
                ->json([
                    "success" => false,
                    "data" => []
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($dni)
    {
        try {
            $record = Customer::findOrFail($dni);
            if ($record->status == "trash") {
                return response()
                    ->json([
                        "success" => false,
                        "data" => [],
                        "message" => "Registro no existe"
                    ], 422);
            }
            $record->status = "trash";
            $record->save();
            return response()
                ->json([
                    "success" => true,
                    "data" => CustomerResource::make($record)
                ], 200);
        } catch (\Exception $error) {
            return response()
                ->json([
                    "success" => false,
                    "data" => []
                ], 500);
        }
    }
}
