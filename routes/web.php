<?php

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/**
 * AXIOS ROUTES
 */
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
Route::post('/items', [App\Http\Controllers\ItemController::class, 'store']);

Route::get('/items/{id}', [App\Http\Controllers\ItemController::class, 'show']);
Route::put('/items/{id}', [App\Http\Controllers\ItemController::class, 'update']);
Route::delete('/items/{id}', [App\Http\Controllers\ItemController::class, 'destroy']);


/**
 * Vue.js Routes
 */
// Simple View
Route::get('vue', function () {
    return view('vue');
});

// Create a form request
Route::get('/data', [App\Http\Controllers\DataController::class, 'index'] );
Route::post('/save', [App\Http\Controllers\DataController::class, 'saveData']);
