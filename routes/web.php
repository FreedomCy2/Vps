<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// PATIENT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/patient/book', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/patient/book', [AppointmentController::class, 'store'])->name('appointments.store');
});

// DOCTOR ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorIndex'])->name('appointments.doctor.index');
    Route::post('/doctor/appointments/{appointment}/accept', [AppointmentController::class, 'accept'])->name('appointments.accept');
    Route::post('/doctor/appointments/{appointment}/decline', [AppointmentController::class, 'decline'])->name('appointments.decline');
});

// ADMIN ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/admin/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/admin/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/admin/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

/*
|--------------------------------------------------------------------------
| USER SETTINGS (Volt) — these still need auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
