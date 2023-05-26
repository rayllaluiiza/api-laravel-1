<?php

use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
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

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('videos', VideoController::class);
    Route::get('categorias/{id}/videos', [CategorieController::class, 'videoByCategorie']);
    Route::apiResource('categorias', CategorieController::class);
});
