<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BroadcastController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProspectController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\TwilioController;
use App\Http\Controllers\User\RespondentController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/home');

Route::get('/admin/redirect/auth', [AuthController::class, 'handleMiddlewareRedirect'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'submitLogin'])->name('submitLogin');

    Route::get('/register', [RegisterController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [RegisterController::class, 'submitRegister'])->name('submitRegister');

    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/home', [DashboardController::class, 'showHome'])->name('home');
        Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications');
        Route::get('/faqs', [FaqController::class, 'showFaqs'])->name('faqs');
        Route::get('/broadcast', [BroadcastController::class, 'showBroadcast'])->name('broadcast');

        Route::resource('prospect', ProspectController::class)->parameters([
            'prospect' => 'respondent'
        ]);
    });
});

Route::get('/f/{brand:slug}', [RespondentController::class, 'showPage'])->name('respondent.showPage');
Route::post('/f/{brand:slug}', [RespondentController::class, 'submit'])->name('respondent.submit');

// Chart Ajax
Route::get('/dashboard/chart-data', [DashboardController::class, 'ajaxChartData'])->name('dashboard.chart-data');
Route::get('/dashboard/detailed-chart-data', [DashboardController::class, 'ajaxDetailedChartData']);

Route::post('/twilio/fetch-template', [TwilioController::class, 'fetchTemplate'])
    ->name('twilio.fetch-template');
Route::post('/twilio/save-broadcast', [TwilioController::class, 'saveBroadcast'])
    ->name('twilio.save-broadcast');
