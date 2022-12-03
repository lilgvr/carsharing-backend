<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return CarType::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new CarType();
        $data = $request->input();

        $type->title = $data["title"];
        $type->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CarType $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CarType $carType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CarType $carType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarType $carType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CarType $carType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarType $carType)
    {
        //
    }
}
