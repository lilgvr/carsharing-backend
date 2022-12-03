<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Brick\Math\BigInteger;
use http\Message;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Car::all();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $car = new Car();
        $data = $request->input();

        $this->editCar($data, $car);

        $car->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $car = Car::all()->find($id);
        if (!$car) return response(null, 404);
        return $car;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $data = $request->input();
        $car = Car::all()->find($id);
        if (!$car) return response()->json(['message' => 'Not found', 'status' => 404]);

        $this->editCar($data, $car);

        $car->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }

    /**
     * @param mixed $data
     * @param mixed $car
     * @return void
     */
    private function editCar(mixed $data, mixed $car): void
    {
        $car->company_id = $data['company_id'];
        $car->brand = $data['brand'];
        $car->type_id = $data['type_id'];
        $car->color_id = $data['color_id'];
        $car->tariff_id = $data['tariff_id'];
        $car->production_year = $data['production_year'];
    }
}
