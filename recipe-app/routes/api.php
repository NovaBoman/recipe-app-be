<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListEntryController;
use App\Http\Controllers\RecipeListController;
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

header('Access-Control-Allow-Origin:  *');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(
    function () {

        // User routes
        Route::post('/logout', [AuthController::class, 'logout']);

        // Recipe lists
        Route::get('/lists', [RecipeListController::class, 'index']);
        Route::get('/lists/{id}', [RecipeListController::class, 'show']);
        Route::post('/lists', [RecipeListController::class, 'store']);
        Route::put('/lists/{id}/update', [RecipeListController::class, 'update']);
        Route::delete('/lists/{id}/delete', [RecipeListController::class, 'destroy']);

        // List entries
        Route::post('/lists/entry', [ListEntryController::class, 'store']);
        Route::delete('/entry/{id}/delete', [ListEntryController::class, 'destroy']);
    }
);
