<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Tariff;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TariffController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Tariff::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->input();
        $tariff = new Tariff();

        $tariff->title = $data['title'];
        $tariff->cost = $data['cost'];

        $tariff->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tariff $tariff
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Tariff $tariff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tariff $tariff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tariff $tariff
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $tariff = Tariff::all()->find($id);

        if (!$tariff) return response()->json(['message' => 'Not found', 'status' => 404], 404);

        $tariff->delete();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }
}
