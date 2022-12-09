<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\CarsInCity;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarsInCityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return CarsInCity::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $cars = new CarsInCity();
        $data = $request->input();

        try {
            $cars->car_id = $data['car_id'];
            $cars->city_id = $data['city_id'];

        } catch (Exception $exception) {
            return response()->json([
                'message' => 'One of required fields is empty',
                'status' => 400
            ], 400);
        }

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $cars]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CarsInCity $carsInCity
     * @return \Illuminate\Http\Response
     */
    public function show(CarsInCity $carsInCity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CarsInCity $carsInCity
     * @return \Illuminate\Http\Response
     */
    public function edit(CarsInCity $carsInCity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\CarsInCity $carsInCity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarsInCity $carsInCity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CarsInCity $carsInCity
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarsInCity $carsInCity)
    {
        //
    }
}
