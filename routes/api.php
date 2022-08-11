<?php

use App\Http\Controllers\DownloadEpisodeController;
use App\Http\Controllers\EpisodeController;
use App\Models\Episode;
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


Route::apiResource('/episodes', EpisodeController::class)->only(['index']);

Route::apiResource('/downloads/episodes', DownloadEpisodeController::class)
    ->scoped(['episode' => 'uuid'])
    ->only(['show']);
