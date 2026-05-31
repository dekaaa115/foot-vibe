<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('front.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Logika Unggah Foto
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && \Illuminate\Support\Facades\Storage::exists('public/' . $user->profile_photo)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $user->profile_photo);
            }

            // Upload foto baru
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // PERBAIKAN: Menyimpan semua data teks ke database
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil dan data diri berhasil diperbarui!');
    }

    public function orders()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil data pesanan milik user ini, urutkan dari yang terbaru
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('front.orders', compact('user', 'orders'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'current_password.current_password' => 'Password lama yang kamu masukkan salah.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru harus minimal 8 karakter.'
        ]);

        $user = $request->user();

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('success', 'Password akun kamu berhasil diperbarui!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('profile');
    }
}
