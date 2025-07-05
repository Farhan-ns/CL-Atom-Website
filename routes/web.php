<?php

use App\Http\Controllers\User\RespondentController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/f/{brand:slug}', [RespondentController::class, 'showPage'])->name('respondent.showPage');
Route::post('/f/{brand:slug}', [RespondentController::class, 'submit'])->name('respondent.submit');
