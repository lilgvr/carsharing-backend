<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ColorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Color::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $color = new Color();
        $data = $request->input();

        $color->title = $data['title'];

        $color->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|Color
     */
    public function show(int $id): JsonResponse|Color
    {
        $color = Color::all()->find($id);
        if (!$color) return response()->json(['message' => 'Not found', 'status' => 404], 404);
        return $color;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Color $color
     * @return Response
     */
    public function edit(Color $color)
    {

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
        $color = Color::all()->find($id);

        if (!$color) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $color->title = $data['title'];

        $color->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $color]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $color = Color::all()->find($id);

        if (!$color) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $color->delete();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }
}
