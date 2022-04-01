<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User routes



// Recipe lists

Route::get('/lists', [RecipeListController::class, 'index']);
Route::get('/lists/{id}', [RecipeListController::class, 'show']);
Route::post('/lists', [RecipeListController::class, 'store']);
Route::put('/lists/{id}/update', [RecipeListController::class, 'update']);
Route::delete('/lists/{id}/delete', [RecipeListController::class, 'destroy']);


// List entries

Route::post('/lists/{id}/entry', [ListEntryController::class, 'store']);
Route::delete('/entry/{id}/delete', [ListEntryController::class, 'destroy']);
