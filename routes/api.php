<?php

use App\Http\Controllers\API\CarCompanyController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\CarsInCityController;
use App\Http\Controllers\API\CarTypeController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\RentCarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/cars' => CarController::class,
    '/carTypes' => CarTypeController::class,
    '/cities' => CityController::class,
    '/companies' => CarCompanyController::class,
    '/colors' => ColorController::class,
    '/rentCar' => RentCarController::class,
    '/carsInCity' => CarsInCityController::class,
    '/users' => UserController::class
]);

/*
|--------------------------------------------------------------------------
| Authentication API Routes
|--------------------------------------------------------------------------
|
*/

Route::group([

    'middleware' => ['api'],
    'prefix' => 'auth'

], function () {

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

});
