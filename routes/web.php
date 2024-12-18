<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/domain', DomainController::class);
    Route::resource('/pages', PageController::class);
    Route::get('/getDomainLook', [DomainController::class, 'getDomainLook']);
});
Route::get('/getStatusUrl', [PageController::class, 'getStatusUrl']);
Route::get('/setEnablePageVerify', [PageController::class, 'setEnablePageVerify']);

require __DIR__ . '/auth.php';
