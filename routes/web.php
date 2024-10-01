<?php

use App\Http\Controllers\ClientFormController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    '2FA',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['checkRole:2,3'])->group(function () {
        Route::get('/client-form/{client_form:slug}/evaluate', [EvaluationController::class, 'show'])
            ->name('client_form.evaluate');

        Route::post('/client-form/{id}/evaluate', [EvaluationController::class, 'store'])
            ->name('client_form.evaluate.store');
        Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluation.index');

        Route::get('/evaluation/{evaluation:slug}/plan/{plan:slug}', [PlanController::class, 'show'])->name('evaluation.plan.show');
    });

    Route::resource('client_form', ClientFormController::class)
        ->only(['create', 'store'])->middleware('checkRole:4');
});
