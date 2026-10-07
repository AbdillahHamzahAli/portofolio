<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        if (User::query()->where('email', $request->input('email'))->where('is_admin', true)->exists()) {
            Password::sendResetLink($request->only('email'));
        }

        return back()->with('status', 'Jika email terdaftar sebagai admin, tautan reset kata sandi akan dikirim.');
    }
}
