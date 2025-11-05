<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Doctor\DoctorRegisterController;
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\DoctorForgotPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\UserBookingHistory2;

// ------------------
// Home Route
// ------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ------------------
// Admin Public Routes
// ------------------
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/register', function () {
    return view('admin.register');
})->name('admin.register');

// ------------------
// Admin Pages with Login Check
// ------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('booking', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return app(\App\Http\Controllers\Admin\BookingController::class)->index();
    })->name('booking');

    Route::get('doctors', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return app(\App\Http\Controllers\Admin\DoctorController::class)->index();
    })->name('doctors');

    Route::get('manage-users', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return app(\App\Http\Controllers\Admin\UserCrudController::class)->index();
    })->name('manage-users');

    Route::get('reminders', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.reminders');
    })->name('reminders');

    Route::get('schedule', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.schedule');
    })->name('schedule');

    Route::get('records', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return app(\App\Http\Controllers\Admin\RecordsController::class)->index();
    })->name('records');

    Route::get('contact-support', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.contact-support');
    })->name('support');

    Route::post('support/send', [SupportController::class, 'send'])->name('support.send');
});

// ------------------
// Admin Authentication Routes
// ------------------
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.register.submit');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');

    // Bookings CRUD
    Route::get('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.bookings.store');
    Route::delete('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('admin.bookings.show');
    Route::put('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('admin.bookings.update');

    // Doctors CRUD
    Route::post('/doctors', [\App\Http\Controllers\Admin\DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'show'])->name('admin.doctors.show');
    Route::put('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

    // Users CRUD
    Route::post('/users', [UserCrudController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [UserCrudController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [UserCrudController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserCrudController::class, 'destroy'])->name('admin.users.destroy');

    // Records CRUD
    Route::get('/records', [\App\Http\Controllers\Admin\RecordsController::class, 'index'])->name('admin.records.index');
    Route::post('/records', [\App\Http\Controllers\Admin\RecordsController::class, 'store'])->name('admin.records.store');
    Route::get('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'show'])->name('admin.records.show');
    Route::put('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'update'])->name('admin.records.update');
    Route::delete('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'destroy'])->name('admin.records.destroy');
});

// ------------------
// Admin Forgot Password
// ------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('forgot-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

// ------------------
// Admin Logout
// ------------------
Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
})->name('logout');

// ------------------
// User Registration & Login Routes
// ------------------
Route::get('/user/register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');
Route::post('/user/register', [UserRegisterController::class, 'register'])->name('user.register.submit');
Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// User register route (for form submission from register.blade.php)
Route::post('/register', [UserRegisterController::class, 'register'])->name('register');

// ------------------
// User Routes - Protected by Session Check
// ------------------
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', function (Request $request) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return view('user.profile');
    })->name('profile');

    // NEW: Updated history route to use UserBookingHistory2 controller
    Route::get('/history', [UserBookingHistory2::class, 'index'])->name('history');

    Route::get('/edit', function (Request $request) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return view('user.edit');
    })->name('edit');
});

// ------------------
// User Routes (Public)
// ------------------
Route::get('/user/booking', fn() => view('user.booking'))->name('user.booking');
Route::get('/user/cancel', fn() => view('user.cancel'))->name('user.cancel');
Route::get('/user/changepassword', fn() => view('user.changepassword'))->name('user.changepassword');
Route::get('/user/confirm', fn() => view('user.confirm'))->name('user.confirm');
Route::get('/user/forgotpassword', fn() => view('user.forgotpassword'))->name('user.forgotpassword');
Route::get('/user/introduction', fn() => view('user.introduction'))->name('user.introduction');
Route::get('/user/service', fn() => view('user.service'))->name('user.service');

Route::get('/user/information', [UserBookingController::class, 'create'])->name('user.information.form');
Route::post('/user/information', [UserBookingController::class, 'store'])->name('user.information');

Route::get('/user/information2', function () {
    return view('user.information2');
})->name('user.information2');

// ------------------
// NEW: User Booking History Routes (UserBookingHistory2 Controller)
// ------------------
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/booking/{id}', function (Request $request, $id) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return app(UserBookingHistory2::class)->show($request, $id);
    })->name('booking.show');
    
    Route::get('/booking/{id}/edit', function (Request $request, $id) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return app(UserBookingHistory2::class)->edit($request, $id);
    })->name('booking.edit');
    
    Route::put('/booking/{id}', function (Request $request, $id) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return app(UserBookingHistory2::class)->update($request, $id);
    })->name('booking.update');
    
    Route::patch('/booking/{id}/cancel', function (Request $request, $id) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return app(UserBookingHistory2::class)->cancel($request, $id);
    })->name('booking.cancel');
    
    Route::delete('/booking/{id}', function (Request $request, $id) {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }
        return app(UserBookingHistory2::class)->destroy($request, $id);
    })->name('booking.destroy');
});

// ------------------
// Doctor Pages
// ------------------
Route::get('/doctor/login', function () {
    return view('doctor.login');
})->name('doctor.login');

Route::get('/doctor/register', function () {
    return view('doctor.register');
})->name('doctor.register');

// Doctor authentication (POST login and logout)
Route::post('/doctor/login', [DoctorAuthController::class, 'login'])->name('doctor.login.submit');
Route::post('/doctor/logout', [DoctorAuthController::class, 'logout'])->name('doctor.logout');

Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('dashboard', function (Illuminate\Http\Request $request) {
        if (! $request->session()->has('doctor_id')) {
            return redirect()->route('doctor.login');
        }
        return view('doctor.dashboard');
    })->name('dashboard');

    // Doctor appointments routes
    Route::get('appointments', [BookingController::class, 'index'])->name('appointments');
    Route::patch('appointments/{id}/status', [BookingController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('history', [BookingController::class, 'history'])->name('history');
    Route::post('appointments/{id}/accept', [BookingController::class, 'accept'])->name('appointments.accept');
    Route::post('appointments/{id}/decline', [BookingController::class, 'decline'])->name('appointments.decline');
    Route::delete('appointments/{id}', [BookingController::class, 'destroy'])->name('appointments.destroy');
});

Route::get('/doctor/forgot-password', function () {
    return view('doctor.forgot-password');
})->name('doctor.forgot-password');

Route::get('/doctor/availability', function () {
    return view('doctor.availability');
})->name('doctor.availability');

Route::get('/doctor/profile', function () {
    return view('doctor.profile');
})->name('doctor.profile');

Route::get('/doctor/notifications', function () {
    return view('doctor.notifications');
})->name('doctor.notifications');

Route::get('/doctor/register', [DoctorRegisterController::class, 'showRegisterForm'])->name('doctor.showRegister');
Route::post('/doctor/register', [DoctorRegisterController::class, 'register'])->name('doctor.register');

/// ------------------
// Doctor Forgot-Password
// ------------------
Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('forgot-password', [DoctorForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [DoctorForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
});




// ------------------
// Dashboard Views
// ------------------
Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

// ------------------
// Authenticated User Settings (Volt Components)
// ------------------
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route(
        'settings/two-factor',
        'settings.two-factor'
    )->middleware(
        when(
            Features::canManageTwoFactorAuthentication() &&
            Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
            ['password.confirm'],
            [],
        )
    )->name('two-factor.show');
});

// ------------------
// Auth Scaffolding
// ------------------
<<<<<<< HEAD
require __DIR__ . '/auth.php';
=======
require __DIR__ . '/auth.php';
>>>>>>> 7549f97 (please work)
