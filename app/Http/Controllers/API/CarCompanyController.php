<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\CarCompany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarCompanyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return CarCompany::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $company = new CarCompany();
        $data = $request->input();

        $company->title = $data['title'];

        $company->save();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|CarCompany
     */
    public function show(int $id): Response|CarCompany
    {
        $company = CarCompany::all()->find($id);
        if (!$company) return response(null, 404);
        return $company;
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
        $company = CarCompany::all()->find($id);
        if (!$company) return response()->json(['message' => 'Not found', 'status' => 404]);

        $company->title = $data['title'];

        $company->save();

        return response()->json(['message' => 'Success', 'status' => 200, 'data' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $company = CarCompany::all()->find($id);

        if (!$company) return response()->json(['message' => 'Not found', 'status' => 404]);

        $company->delete();

        return response()->json(['message' => 'Success', 'status' => 200]);
    }
}
