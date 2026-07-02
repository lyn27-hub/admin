<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Ditambahkan untuk handle hapus/simpan file storage

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp_number' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'password' => Hash::make($request->password),
            
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil!',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password cocok
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah!'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user
        ], 200);
    }

    /**
     * METHOD BARU: Menangani upload dan pembaruan foto profil user
     * Menjamin data foto tersimpan permanen di database
     */
    public function updateProfilePicture(Request $request, $id)
    {
        // Validasi input file gambar
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari user berdasarkan ID yang dikirim dari Flutter
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan!'
            ], 404);
        }

        // Hapus foto profil lama dari server jika sebelumnya sudah pernah upload
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Simpan file baru ke dalam folder: storage/app/public/profile_pictures
        $path = $request->file('image')->store('profile_pictures', 'public');

        // Simpan path file baru tersebut ke dalam database tabel users kolom profile_picture
        $user->profile_picture = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui!',
            // Kembalikan URL absolut agar Flutter Web/Mobile bisa langsung merender lewat Image.network
            'profile_picture_url' => asset('storage/' . $path)
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'whatsapp_number' => 'nullable'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
        ]);

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }
}