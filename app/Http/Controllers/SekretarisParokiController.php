<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SekretarisParokiController extends Controller
{
    public function dashboard()
    {
        // Pastikan Anda menangani kasus ketika tidak ada pengumuman sama sekali
        // Jika tidak ada, $latestAnnouncement akan menjadi null, yang akan menyebabkan error di view jika tidak dicek.
        // Lebih baik inisialisasi objek baru jika tidak ditemukan.
        $latestAnnouncement = Pengumuman::latest()->first() ?? new Pengumuman();
        return view('dashboard.sekretaris_paroki', compact('latestAnnouncement'));
    }

    public function updateAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'nullable|string|max:255',
            'tanggal_kolekte' => 'required|date',
            'jumlah_kolekte' => 'required|numeric|min:0',
            // HAPUS VALIDASI 'content' dari sini, karena kita akan membuatnya secara otomatis
            // 'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Gagal menyimpan pengumuman. Mohon periksa kembali input Anda.');
        }

        $validatedData = $validator->validated();

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // --- BAGIAN KUNCI: MEMBANGUN TEKS UNTUK KOLOM 'content' SECARA OTOMATIS ---
        $tanggalFormatted = \Carbon\Carbon::parse($validatedData['tanggal_kolekte'])->translatedFormat('d F Y');
        $jumlahFormatted = number_format($validatedData['jumlah_kolekte'], 0, ',', '.'); // Format angka tanpa desimal

        // Buat string konten lengkap yang akan disimpan ke kolom 'content'
        // Ini adalah teks yang akan muncul di dashboard Bendahara Stasi
        $contentUntukTabel = "Perolehan Kolekte Misa Tanggal {$tanggalFormatted} dengan Jumlah Rp {$jumlahFormatted}.";

        // Tentukan judul pengumuman, gunakan default jika kosong
        $judulPengumuman = $validatedData['judul'] ?: "Pengumuman Kolekte Misa";


        $announcement = Pengumuman::latest()->first();

        if ($announcement) {
            // Update pengumuman yang sudah ada
            $announcement->update([
                'judul' => $judulPengumuman, // Gunakan judul yang sudah diatur
                'tanggal_kolekte' => $validatedData['tanggal_kolekte'],
                'jumlah_kolekte' => $validatedData['jumlah_kolekte'],
                'content' => $contentUntukTabel, // <<<--- SIMPAN HASIL GENERASI OTOMATIS DI SINI
                'user_id' => $userId,
            ]);
            $message = 'Pengumuman kolekte berhasil diperbarui!';
        } else {
            // Buat pengumuman baru
            Pengumuman::create([
                'judul' => $judulPengumuman, // Gunakan judul yang sudah diatur
                'tanggal_kolekte' => $validatedData['tanggal_kolekte'],
                'jumlah_kolekte' => $validatedData['jumlah_kolekte'],
                'content' => $contentUntukTabel, // <<<--- SIMPAN HASIL GENERASI OTOMATIS DI SINI
                'user_id' => $userId,
            ]);
            $message = 'Pengumuman kolekte berhasil ditambahkan!';
        }

        return redirect()->back()->with('success', $message);
    }
}