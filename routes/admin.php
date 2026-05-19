<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::get('/media/browser', [MediaController::class, 'browser'])->name('media.browser');
    Route::get('/homepage', [HomepageController::class, 'edit'])->name('homepage.edit');
    Route::put('/homepage', [HomepageController::class, 'update'])->name('homepage.update');
    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('team', TeamMemberController::class)->except('show');
    Route::resource('partners', PartnerController::class)->except('show');
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::put('/inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
