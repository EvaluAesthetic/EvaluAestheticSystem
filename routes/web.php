<?php

use App\Http\Controllers\ClientFormController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EvaluationController;
use App\Http\Middleware\EnsureUserIsClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/client_form/{id}/evaluate', [EvaluationController::class, 'create'])
        ->name('client_form.evaluate');

    Route::post('/client_form/{id}/evaluate', [EvaluationController::class, 'store'])
        ->name('client_form.evaluate.store');
    Route::resource('client_form', ClientFormController::class)
        ->only(['create', 'store']);
});
