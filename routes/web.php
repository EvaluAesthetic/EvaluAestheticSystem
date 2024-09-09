<?php

use App\Http\Controllers\ClientFormController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\PlanController;
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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); // all roles

    Route::middleware(['checkRole:2,3'])->group(function () {
        Route::get('/client_form/{id}/evaluate', [EvaluationController::class, 'show'])
            ->name('client_form.evaluate'); //Only professionals

        Route::post('/client_form/{id}/evaluate', [EvaluationController::class, 'store'])
            ->name('client_form.evaluate.store'); //Only professionals
        Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluation.index');

        Route::get('/evaluation/{evaluation}/plan/{plan}', [PlanController::class, 'show'])->name('evaluation.plan.show');
    });

    Route::resource('client_form', ClientFormController::class)
        ->only(['create', 'store'])->middleware('checkRole:4');
});
