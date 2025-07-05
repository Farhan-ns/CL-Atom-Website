<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Respondent;
use Illuminate\Http\Request;

class RespondentController extends Controller
{
    public function showPage(Brand $brand)
    {
        return view('respondent.form', [
            'brand' => $brand
        ]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'religion' => ['required'],
            'coming_from' => ['required'],
            'birthdate' => ['required'],
        ]);

        $validated['religion'] = str($validated['religion'])->title();
        $validated['coming_from'] = str($validated['coming_from'])->title();

        Respondent::create($validated);

        return redirect()
            ->back()
            ->with('success', true);
    }
}
