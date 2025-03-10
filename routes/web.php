<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/payment-plan/{user}', [PaymentPlanController::class, 'index'])->name('payment-plan.index');
Route::post('/payment-plan/{user}', [PaymentPlanController::class, 'assign'])->name('payment-plan.assign');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::post('customers/activeToggle/{customer}', [CustomerController::class, 'activationToggle'])->name('customers.activationToggle');
    });
});

require __DIR__ . '/auth.php';
