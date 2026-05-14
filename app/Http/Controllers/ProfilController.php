<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function show(Request $request): View
    {
        return view('contents.pendaftar.profil.index', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('contents.pendaftar.profil.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user !== null, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'string', 'required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed', 'required_with:current_password'],
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa email yang valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'current_password.required_with' => 'Password lama wajib diisi untuk mengganti password.',
            'new_password.required_with' => 'Password baru wajib diisi jika password lama diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($request->filled('new_password')) {
            if (! Hash::check((string) $request->input('current_password'), $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Password lama yang Anda masukkan tidak sesuai.'])
                    ->withInput();
            }

            $user->password = $validated['new_password'];
        }

        if ($request->hasFile('foto')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $user->foto_profil = $request->file('foto')->store('profil', 'public');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()
            ->route('profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
