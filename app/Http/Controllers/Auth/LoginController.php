<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('contents.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa email yang valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var User|null $user */
            $user = Auth::user();

            $redirectRoute = $user?->isAdmin() ? 'admin.dashboard' : 'beranda';

            return redirect()
                ->intended(route($redirectRoute))
                ->with('success', 'Anda berhasil masuk ke sistem.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password yang Anda masukkan tidak cocok dengan data kami.',
            ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil keluar dari sistem.');
    }

    public function destroyAdmin(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil keluar dari panel admin.');
    }
}
