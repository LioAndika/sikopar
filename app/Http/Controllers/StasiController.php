<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stasi; // Import model Stasi Anda
use Illuminate\Validation\Rule; // Diperlukan untuk validasi 'unique' saat update

class StasiController extends Controller
{
    /**
     * Menampilkan daftar semua stasi.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stasis = Stasi::all(); // Mengambil semua data stasi
        return view('super_admin.stasi.index', compact('stasis'));
    }

    /**
     * Menampilkan formulir untuk membuat stasi baru.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('super_admin.stasi.create');
    }

    /**
     * Menyimpan stasi baru ke database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:stasi,nama', // 'nama' harus unik
            'alamat' => 'nullable|string|max:500',
            // Jika ada kolom 'telepon' di tabel 'stasi' dan di $fillable model Stasi Anda,
            // Anda bisa tambahkan validasi di sini:
            // 'telepon' => 'nullable|string|max:20',
        ]);

        Stasi::create($request->all()); // Membuat stasi baru dengan data dari request

        return redirect()->route('super-admin.stasi.index')->with('success', 'Stasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit stasi yang spesifik.
     * @param  \App\Models\Stasi  $stasi
     * @return \Illuminate\View\View
     */
    public function edit(Stasi $stasi)
    {
        return view('super_admin.stasi.edit', compact('stasi'));
    }

    /**
     * Memperbarui stasi yang spesifik di database.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stasi  $stasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Stasi $stasi)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                // Pastikan 'nama' unik, kecuali untuk stasi yang sedang diedit
                Rule::unique('stasi', 'nama')->ignore($stasi->id),
            ],
            'alamat' => 'nullable|string|max:500',
            // Jika ada kolom 'telepon' di tabel 'stasi' dan di $fillable model Stasi Anda,
            // Anda bisa tambahkan validasi di sini:
            // 'telepon' => 'nullable|string|max:20',
        ]);

        $stasi->update($request->all()); // Memperbarui data stasi

        return redirect()->route('super-admin.stasi.index')->with('success', 'Stasi berhasil diperbarui.');
    }

    /**
     * Menghapus stasi dari database.
     * @param  \App\Models\Stasi  $stasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Stasi $stasi)
    {
        $stasi->delete(); // Menghapus stasi
        return redirect()->route('super-admin.stasi.index')->with('success', 'Stasi berhasil dihapus.');
    }
}