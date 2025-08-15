<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\v1\AuthController as AuthControllerV1;
use App\Http\Controllers\API\v2\AuthController as AuthControllerV2;
use App\Http\Controllers\costumer\CostumerController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {
    Route::post('login', [AuthControllerV1::class, 'login']);
    Route::post('register', [AuthControllerV1::class, 'register']);
    Route::post('logout', [AuthControllerV1::class, 'logout']);
    Route::post('refresh', [AuthControllerV1::class, 'refresh']);
    Route::post('me', [AuthControllerV1::class, 'me']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'v2/auth'

], function ($router) {
    Route::post('login', [AuthControllerV2::class, 'login']);
    Route::post('register', [AuthControllerV2::class, 'register']);
    Route::post('logout', [AuthControllerV2::class, 'logout']);
    Route::post('refresh', [AuthControllerV2::class, 'refresh']);
    Route::post('me', [AuthControllerV2::class, 'me']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'crud',
], function () {
    Route::get('get', [UserController::class, 'index']);
    Route::post('post', [UserController::class, 'store']);
    Route::put('put/{id}', [UserController::class, 'update']);
    Route::patch('patch/{id}', [UserController::class, 'patch']);
    Route::delete('delete/{id}', [UserController::class, 'destroy']);
    Route::post('/upload', [FileController::class, 'upload']);
});
