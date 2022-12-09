<?php

use App\Http\Controllers\API\CarCompanyController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\CarsInCityController;
use App\Http\Controllers\API\CarTypeController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\RentCarController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
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
    '/carsInCity' => CarsInCityController::class
]);

Route::apiResource('/users', UserController::class)->middleware('check.role');


/*
|--------------------------------------------------------------------------
| Authentication API Routes
|--------------------------------------------------------------------------
|
*/

Route::apiResource('/register', RegisteredUserController::class)
    ->middleware('guest');

Route::apiResource('/login', AuthenticatedSessionController::class)
    ->middleware(['guest', 'web']);

Route::apiResource('/forgot-password', PasswordResetLinkController::class)
    ->middleware('guest');

Route::apiResource('/reset-password', NewPasswordController::class)
    ->middleware('guest');

Route::apiResource('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1']);

Route::apiResource('/email/verification-notification', EmailVerificationNotificationController::class)
    ->middleware(['auth', 'throttle:6,1']);

Route::apiResource('/logout', AuthenticatedSessionController::class)
    ->middleware('auth');
