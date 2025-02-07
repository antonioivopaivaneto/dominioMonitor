<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {



Route::post('/login', [AuthController::class, 'login']);

});


Route::get('/data', function () {
    return response()->json([
        'message' => 'Hello from Laravel!',
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2',
        ],
    ]);
});


// routes/api.php
Route::post('/addurl', function (Request $request) {
    $validatedData = $request->validate([
        'url' => 'required|url',
        'phone' => 'required|string',
    ]);

    // Process the data (e.g., save to database)
    // For now, just return the data as a response
    return response()->json([
        'status' => 'success',
        'data' => $validatedData,
    ]);
});
