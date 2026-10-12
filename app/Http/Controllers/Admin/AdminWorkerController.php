<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminWorkerController extends Controller
{
    /**
     * Tambah petugas tim lapangan baru beserta profil dan upload KTP (PRD Flow 2).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:8'],
            'ktp_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.required' => 'Nama lengkap petugas wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'phone.required' => 'Nomor telepon/WhatsApp wajib diisi.',
            'address.required' => 'Alamat domisili wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi (minimal 8 karakter).',
            'ktp_photo.required' => 'Foto KTP wajib diunggah.',
            'ktp_photo.image' => 'File KTP harus berupa gambar (JPG, PNG, atau WEBP).',
            'ktp_photo.max' => 'Ukuran file foto KTP maksimal 2MB.',
        ]);

        // Simpan file foto KTP ke public storage
        $ktpPath = $request->file('ktp_photo')->store('ktp_photos', 'public');

        $worker = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => 'WORKER',
            'password' => Hash::make($validated['password']),
        ]);

        WorkerProfile::create([
            'user_id' => $worker->id,
            'address' => $validated['address'],
            'ktp_photo_url' => Storage::url($ktpPath),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('status', 'Petugas tim lapangan "' . $worker->name . '" berhasil didaftarkan ke sistem.');
    }
}
