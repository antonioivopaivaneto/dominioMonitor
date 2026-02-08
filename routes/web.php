<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\VerificacaoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing/Home');
})->name('landing');


Route::post('/baixar-pdf', [LeadController::class, 'store'])->name('lead.store');
Route::get('/download-pdf', [LeadController::class, 'download'])->name('download.pdf');

Route::get('/reports',[ReportController::class,'show'])->middleware(['auth', 'verified'])->name('report.show');
Route::get('/report',[ReportController::class,'index'])->middleware(['auth', 'verified'])->name('report.index');
Route::get('/tips',[TipsController::class,'index'])->middleware(['auth', 'verified'])->name('tips.index');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/verificacao', VerificacaoController::class);
    Route::resource('/domain', DomainController::class);
    Route::resource('/pages', PageController::class);
    Route::get('/getDomainLook', [DomainController::class, 'getDomainLook']);
});
Route::get('/getStatusUrl', [PageController::class, 'getStatusUrl']);
Route::get('/setEnablePageVerify', [PageController::class, 'setEnablePageVerify']);

require __DIR__ . '/auth.php';
