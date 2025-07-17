<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TwilioTemplate;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function showBroadcast()
    {
        return view('pages.broadcast', [
            'twilioTemplate' => TwilioTemplate::firstOrCreate(),
        ]);
    }
}
