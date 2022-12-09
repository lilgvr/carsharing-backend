<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Car::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $car = new Car();
        $data = $request->input();

        $this->editCar($data, $car);

        $car->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $car]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|Car
     */
    public function show(int $id): JsonResponse|Car
    {
        $car = Car::all()->find($id);
        if (!$car) return response()->json(['message' => 'Not found', 'status' => 404], 404);
        return $car;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->input();
        $car = Car::all()->find($id);

        if (!$car) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $this->editCar($data, $car);

        $car->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $car]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $car = Car::all()->find($id);

        if (!$car) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $car->delete();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    // TODO cast to number

    /**
     * @param mixed $data
     * @param mixed $car
     * @return void
     */
    private function editCar(mixed $data, mixed $car): void
    {
        if (array_key_exists('type_id', $data)) $car->type_id = (int)$data['type_id'];
        if (array_key_exists('company_id', $data)) $car->company_id = (int)$data['company_id'];
        if (array_key_exists('color_id', $data)) $car->color_id = (int)$data['color_id'];
        if (array_key_exists('tariff_id', $data)) $car->tariff_id = (int)$data['tariff_id'];
        if (array_key_exists('production_year', $data)) $car->production_year = (int)$data['production_year'];
        if (array_key_exists('mileage', $data)) $car->mileage = (int)$data['mileage'];
        if (array_key_exists('lat', $data)) $car->lat = (float)$data['lat'];
        if (array_key_exists('lng', $data)) $car->lng = (float)$data['lng'];
        $car->brand = $data['brand'] ?? $car->brand;
    }
}
