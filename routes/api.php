<?php

use App\Http\Controllers\BabyController;
use App\Http\Controllers\ParentUserAuthController;
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

Route::get('/parents',[ParentUserController::class,'index'])
    ->name('parents.index');

Route::post('parent/register', [ParentUserAuthController::class, 'register'])
    ->name('parent.register');

Route::post('parent/login', [ParentUserAuthController::class, 'login'])
    ->name('parent.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
