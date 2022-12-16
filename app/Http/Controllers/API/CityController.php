<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return City::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $city = new City();
        $data = $request->input();

        $city->title = $data['title'];

        $city->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        $city = City::all()->find($id);
        if (!$city) return response(null, 404);
        return $city;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param City $city
     * @return Response
     */
    public function update(Request $request, City $city)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return Response
     */
    public function destroy(City $city)
    {

    }
}
