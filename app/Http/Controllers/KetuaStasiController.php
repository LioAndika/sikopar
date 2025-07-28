<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanKolekte;
use App\Models\Stasi;
use App\Models\User; // Pastikan ini diimpor jika Anda menggunakannya

class KetuaStasiController extends Controller
{
    /**
     * Menampilkan daftar laporan kolekte yang perlu divalidasi dan yang sudah divalidasi.
     * Ketua Stasi melihat laporan dari stasi mereka.
     * Super Admin dapat melihat semua laporan pending atau memilih stasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $stasiIdKetua = null;
        $namaStasi = '';

        if ($user->hasRole('super-admin')) {
            $namaStasi = 'Semua Stasi';
            // Logic for super admin filter can be added here if needed
            // e.g., if ($request->has('stasi_id')) { ... }
        } elseif ($user->hasRole('ketua-stasi')) {
            $stasiIdKetua = $user->stasi_id;

            if (!$stasiIdKetua) {
                return redirect()->back()->with('error', 'Akun Ketua Stasi Anda belum terhubung dengan stasi mana pun.');
            }

            // Pastikan relasi 'stasi' ada dan berfungsi di model User Anda dan menggunakan kolom 'nama'
            $namaStasi = $user->stasi ? $user->stasi->nama : 'Stasi Tidak Dikenal';

        } else {
            return redirect()->route('dashboard.general')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        // Query untuk laporan yang status_ketua_stasi nya 'pending'
        $queryPending = LaporanKolekte::query();
        if ($stasiIdKetua) {
            $queryPending->where('stasi_id', $stasiIdKetua);
        }
        $laporanKolektesPending = $queryPending->where('status_ketua_stasi', 'pending')
                                                 ->orderBy('tanggal_kolekte', 'desc')
                                                 ->orderBy('created_at', 'desc') // Tambahkan baris ini
                                                 ->get();

        // Query untuk laporan yang status_ketua_stasi nya 'divalidasi' atau 'ditolak'
        // Termasuk laporan yang ditolak ketua stasi (yang otomatis menolak status bendahara/romo)
        $queryProcessed = LaporanKolekte::query();
        if ($stasiIdKetua) {
            $queryProcessed->where('stasi_id', $stasiIdKetua);
        }
        $laporanKolektesProcessed = $queryProcessed->whereIn('status_ketua_stasi', ['divalidasi', 'ditolak'])
                                                     ->with('createdBy')
                                                     ->orderBy('tanggal_kolekte', 'desc')
                                                     ->orderBy('created_at', 'desc') // Tambahkan baris ini
                                                     ->get();

        return view('ketua_stasi.laporan.index', compact('laporanKolektesPending', 'laporanKolektesProcessed', 'namaStasi'));
    }

    // ... sisa kode validateLaporan dan rejectLaporan tidak berubah ...
    /**
     * Memvalidasi laporan kolekte oleh Ketua Stasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validateLaporan(Request $request, LaporanKolekte $laporanKolekte)
    {
        $user = Auth::user();

        // Super Admin memiliki hak untuk memvalidasi laporan apapun tanpa terikat stasi_id
        if ($user->hasRole('super-admin')) {
            if ($laporanKolekte->status_ketua_stasi != 'pending') {
                return redirect()->back()->with('error', 'Status laporan sudah berubah.');
            }
        } elseif ($user->hasRole('ketua-stasi')) {
            $stasiIdKetua = $user->stasi_id;
            if ($laporanKolekte->stasi_id != $stasiIdKetua || $laporanKolekte->status_ketua_stasi != 'pending') {
                return redirect()->back()->with('error', 'Anda tidak berhak memvalidasi laporan ini atau statusnya sudah berubah.');
            }
        } else {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $laporanKolekte->status_ketua_stasi = 'divalidasi';
        $laporanKolekte->status_bendahara_paroki = 'pending'; // Diteruskan ke Bendahara Paroki
        // Ketika Ketua Stasi memvalidasi, catatan revisi Ketua Stasi TIDAK perlu di-null-kan.
        // Jika sebelumnya ada catatan penolakan dari Ketua Stasi (misal statusnya 'ditolak' kemudian di-edit oleh Bendahara Stasi dan dikirim ulang),
        // catatan penolakan itu tetap bisa disimpan di catatan_revisi_ketua_stasi.
        // Kita hanya perlu memastikan catatan bendahara dan romo direset atau dibiarkan kosong
        $laporanKolekte->catatan_revisi_bendahara_paroki = null; // Pastikan ini null saat diteruskan
        $laporanKolekte->catatan_revisi_romo_paroki = null; // Pastikan ini null saat diteruskan
        $laporanKolekte->save();

        return redirect()->route('ketua-stasi.laporan.index')->with('success', 'Laporan kolekte berhasil divalidasi dan diteruskan ke Bendahara Paroki.');
    }

    /**
     * Menolak laporan kolekte oleh Ketua Stasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectLaporan(Request $request, LaporanKolekte $laporanKolekte)
    {
        $validatedData = $request->validate([
            'catatan_revisi_ketua_stasi' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            if ($laporanKolekte->status_ketua_stasi != 'pending') {
                return redirect()->back()->with('error', 'Status laporan sudah berubah.');
            }
        } elseif ($user->hasRole('ketua-stasi')) {
            $stasiIdKetua = $user->stasi_id;
            if ($laporanKolekte->stasi_id != $stasiIdKetua || $laporanKolekte->status_ketua_stasi != 'pending') {
                return redirect()->back()->with('error', 'Anda tidak berhak menolak laporan ini atau statusnya sudah berubah.');
            }
        } else {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $laporanKolekte->status_ketua_stasi = 'ditolak';
        // PERUBAHAN DI SINI: Set status bendahara dan romo paroki menjadi 'ditolak'
        $laporanKolekte->status_bendahara_paroki = 'ditolak';
        $laporanKolekte->status_romo_paroki = 'ditolak';
        
        $laporanKolekte->catatan_revisi_ketua_stasi = $validatedData['catatan_revisi_ketua_stasi'];
        // Opsional: Anda mungkin ingin mengosongkan catatan revisi dari bendahara/romo jika ada sebelumnya
        $laporanKolekte->catatan_revisi_bendahara_paroki = null;
        $laporanKolekte->catatan_revisi_romo_paroki = null;

        $laporanKolekte->save();

        return redirect()->route('ketua-stasi.laporan.index')->with('success', 'Laporan kolekte berhasil ditolak.');
    }
}