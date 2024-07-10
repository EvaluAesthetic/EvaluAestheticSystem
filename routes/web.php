<?php

use App\Http\Controllers\ClientFormController;
use App\Http\Controllers\ClinicController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/registration/{token}/{role_id}', function ($token, $role_id) {
    Log::info('Token: ' . $token);
    Log::info('Role ID: ' . $role_id);
    return view('auth.register', compact('token', 'role_id'));
})->middleware(['guest'])->name('registration');
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
    Route::resource('client_form', ClientFormController::class)->only([
        'create', 'store',
    ]);
    Route::post('/clinic/generate-link/{role_id}', [ClinicController::class, 'generateRegistrationLink'])->name('clinic.generateLink');
});
