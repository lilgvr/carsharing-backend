<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\CarType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarTypeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return CarType::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $type = new CarType();
        $data = $request->input();

        $type->title = $data["title"];
        $type->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse | CarType
     */
    public function show(int $id): CarType|JsonResponse
    {
        $type = CarType::all()->find($id);
        if (!$type) return response()->json(['message' => 'Not found', 'status' => 404], 404);
        return $type;
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
        $type = CarType::all()->find($id);
        $data = $request->input();

        if (!$type) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $type->title = $data['title'];

        $type->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $type = CarType::all()->find($id);

        if (!$type) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $type->delete();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }
}
