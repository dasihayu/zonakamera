<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.passwords.change');
    }

    public function change(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Password changed successfully!');
    }
}
