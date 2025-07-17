<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showFaqs()
    {
        return view('pages.faq', [
            'faqs' => Faq::all(),
        ]);
    }
}
