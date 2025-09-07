<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebConfigController;
use App\Http\Controllers\TripCancellationController;
use App\Http\Controllers\CancellationPolicyController;
use App\Http\Controllers\BookingTermController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Font Test Route
Route::get('/font-test', function () {
    return view('font-test');
})->name('font-test');

// DaisyUI Test Route
Route::get('/test-daisyui', function () {
    return view('test-daisyui');
})->name('test-daisyui');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Change Password Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword']);
});

// Dashboard Routes (Protected)
Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management Routes (Superadmin only)
    Route::middleware(['auth', 'role:superadmin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });
    
    // Web Config Routes (Superadmin only)
    Route::middleware(['auth', 'role:superadmin'])->group(function () {
        Route::get('/webconfig', [WebConfigController::class, 'index'])->name('webconfig.index');
        Route::put('/webconfig', [WebConfigController::class, 'update'])->name('webconfig.update');
    });
    
    // Trip Cancellation Routes (Admin and Superadmin)
    Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
        Route::resource('trip-cancellations', TripCancellationController::class);
        Route::patch('trip-cancellations/{tripCancellation}/toggle-status', [TripCancellationController::class, 'toggleStatus'])->name('trip-cancellations.toggle-status');
        Route::get('trip-cancellations/{tripCancellation}/conditions', [TripCancellationController::class, 'getCancellationConditions'])->name('trip-cancellations.conditions');
    });
    
    // Cancellation Policy Routes (Admin and Superadmin)
    Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
        Route::resource('cancellation-policies', CancellationPolicyController::class);
        Route::patch('cancellation-policies/{cancellationPolicy}/toggle-status', [CancellationPolicyController::class, 'toggleStatus'])->name('cancellation-policies.toggle-status');
        Route::patch('cancellation-policies/{cancellationPolicy}/set-default', [CancellationPolicyController::class, 'setDefault'])->name('cancellation-policies.set-default');
        Route::get('cancellation-policies/{cancellationPolicy}/details', [CancellationPolicyController::class, 'getPolicyDetails'])->name('cancellation-policies.details');
        Route::get('cancellation-policies/active/list', [CancellationPolicyController::class, 'getActivePolicies'])->name('cancellation-policies.active');
    });
    
    // Booking Terms Routes (Admin and Superadmin)
    Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
        Route::resource('booking-terms', BookingTermController::class);
        Route::patch('booking-terms/{bookingTerm}/toggle-status', [BookingTermController::class, 'toggleStatus'])->name('booking-terms.toggle-status');
        Route::patch('booking-terms/{bookingTerm}/toggle-required', [BookingTermController::class, 'toggleRequired'])->name('booking-terms.toggle-required');
        Route::get('booking-terms/{bookingTerm}/details', [BookingTermController::class, 'getTermDetails'])->name('booking-terms.details');
        Route::get('booking-terms/active/list', [BookingTermController::class, 'getActiveTerms'])->name('booking-terms.active');
        Route::post('booking-terms/create-default', [BookingTermController::class, 'createDefaultTerms'])->name('booking-terms.create-default');
    });
});
