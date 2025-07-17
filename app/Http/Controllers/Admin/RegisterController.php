<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('pages.register');
    }

    public function submitRegister(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['nullable'],
            'email' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        $validated['name'] = $validated['first_name'];
        $user = User::create($validated);
        
        Auth::login($user);

        return redirect()->route('admin.home');
    }
}
