<?php

use App\Jobs\SendBirthdayMessage;
use App\Models\Respondent;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $celebratingRespondents = Respondent::whereToday('birthdate')->get();

    foreach ($celebratingRespondents as $respondent) {
        SendBirthdayMessage::dispatch($respondent->email);
    }
})->daily();