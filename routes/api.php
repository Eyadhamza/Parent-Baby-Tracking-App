<?php

use App\Http\Controllers\BabyController;
use App\Http\Controllers\ParentUserController;
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

Route::apiResource('/babies', BabyController::class);

Route::post('/parents/invite',[ParentUserController::class,'invite'])
    ->name('parents.invite');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
