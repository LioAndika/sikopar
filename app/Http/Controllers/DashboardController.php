<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Stasi;
use App\Models\LaporanKolekte; // Pastikan ini diimpor
use App\Models\Pengumuman;
use Carbon\Carbon; // Import Carbon for date formatting
use Illuminate\Support\Facades\DB; // Import DB facade for raw queries

class DashboardController extends Controller
{
    /**
     * Mengarahkan user ke dashboard yang sesuai berdasarkan role mereka setelah login.
     * Ini HANYA BERTANGGUNG JAWAB UNTUK PENGALIHAN AWAL SETELAH LOGIN.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();

        // Mengarahkan ke rute dashboard spesifik berdasarkan peran
        // Kita tidak akan merender view di sini, hanya redirect
        if ($user->hasRole('super-admin')) {
            return redirect()->route('dashboard.super-admin');
        } elseif ($user->hasRole('bendahara-paroki')) {
            return redirect()->route('dashboard.bendahara-paroki');
        } elseif ($user->hasRole('ketua-stasi')) {
            return redirect()->route('dashboard.ketua-stasi');
        } elseif ($user->hasRole('bendahara-stasi')) {
            return redirect()->route('dashboard.bendahara-stasi');
        } elseif ($user->hasRole('sekretaris-paroki')) {
            return redirect()->route('dashboard.sekretaris-paroki');
        } elseif ($user->hasRole('romo-paroki')) {
            return redirect()->route('dashboard.romo-paroki');
        }

        // Fallback jika tidak ada role yang cocok
        return redirect()->route('login'); // Atau route default jika tidak login/role tidak dikenal
    }

    /**
     * Menampilkan dashboard untuk Super Admin.
     * Metode ini akan dipanggil oleh rute 'dashboard.super-admin'.
     * @return \Illuminate\View\View
     */
    public function superAdminDashboard()
    {
        $totalUsers = User::count();
        $totalStasi = Stasi::count();
        $announcement = Pengumuman::latest()->first(); // Get the latest announcement

        // --- Start of Chart Data Logic (MODIFIED) ---
        $now = Carbon::now();
        $chartLabels = [];
        $chartData = [];

        // Loop untuk 3 bulan terakhir (termasuk bulan ini)
        // Dimulai dari 2 bulan lalu (i=2), 1 bulan lalu (i=1), dan bulan ini (i=0)
        for ($i = 2; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i); // Mengambil tanggal bulan yang sesuai
            $month = $date->month;
            $year = $date->year;

            // Format label untuk grafik (misal: "Jul 2025")
            $chartLabels[] = $date->format('M Y');

            // Hitung total kolekte untuk bulan dan tahun ini
            // Menggunakan model LaporanKolekte dan kolom 'tanggal_kolekte' dan 'jumlah_kolekte'
            $totalKolekteBulanIni = LaporanKolekte::whereMonth('tanggal_kolekte', $month)
                                                    ->whereYear('tanggal_kolekte', $year)
                                                    // Filter hanya laporan yang sudah divalidasi oleh KETUA STASI
                                                    ->where('status_ketua_stasi', 'divalidasi')
                                                    // Filter hanya laporan yang sudah divalidasi oleh BENDAHARA PAROKI
                                                    ->where('status_bendahara_paroki', 'divalidasi')
                                                    // Filter hanya laporan yang sudah divalidasi oleh ROMO PAROKI
                                                    ->where('status_romo_paroki', 'divalidasi')
                                                    ->sum('jumlah_kolekte');

            // Tambahkan data kolekte ke array
            $chartData[] = $totalKolekteBulanIni;
        }
        // --- End of Chart Data Logic (MODIFIED) ---

        return view('dashboard.super_admin', compact('totalUsers', 'totalStasi', 'announcement', 'chartLabels', 'chartData'));
    }

    /**
     * Menampilkan dashboard untuk Bendahara Paroki.
     * @return \Illuminate\View\View
     */
    public function bendaharaParokiDashboard()
    {
        // Contoh data untuk bendahara paroki
        $laporanBelumDivalidasiCount = LaporanKolekte::where('status_bendahara_paroki', 'pending')->count();
        // Anda bisa menambahkan logika lain di sini

        return view('dashboard.bendahara_paroki', compact('laporanBelumDivalidasiCount'));
    }

    /**
     * Menampilkan dashboard untuk Ketua Stasi.
     * @return \Illuminate\View\View
     */
    public function ketuaStasiDashboard()
    {
        $user = Auth::user();
        // Asumsi Ketua Stasi terhubung ke satu stasi melalui user->stasi_id
        $stasiIdKetua = $user->stasi_id;

        $laporanPendingKetuaStasi = LaporanKolekte::where('stasi_id', $stasiIdKetua)
                                                    ->where('status_ketua_stasi', 'pending')
                                                    ->count();

        return view('dashboard.ketua_stasi', compact('laporanPendingKetuaStasi'));
    }

    /**
     * Menampilkan dashboard untuk Bendahara Stasi.
     * @return \Illuminate\View\View
     */
    public function bendaharaStasiDashboard()
    {
        $user = Auth::user();
        $stasiIdBendahara = $user->stasi_id;

        if (!$stasiIdBendahara && !$user->hasRole('super-admin')) {
            return redirect()->back()->with('error', 'Akun Bendahara Stasi Anda belum terhubung dengan stasi mana pun.');
        }

        $queryUntukTotalKolekte = LaporanKolekte::query();
        $pendingLaporanCount = LaporanKolekte::query();

        if ($user->hasRole('bendahara-stasi')) {
            $queryUntukTotalKolekte->where('stasi_id', $stasiIdBendahara)
                                   ->where('created_by_user_id', $user->id);
            $pendingLaporanCount->where('stasi_id', $stasiIdBendahara)
                               ->where('created_by_user_id', $user->id);
        }

        $totalKolekte = $queryUntukTotalKolekte->where('status_ketua_stasi', 'divalidasi')
                                                ->where('status_bendahara_paroki', 'divalidasi')
                                                ->where('status_romo_paroki', 'divalidasi')
                                                ->sum('jumlah_kolekte');

        $pendingLaporanCount = $pendingLaporanCount->where('status_ketua_stasi', 'pending')
                                                    ->count();

        $announcement = Pengumuman::latest()->first(); // Mengambil pengumuman terbaru

        return view('dashboard.bendahara_stasi', compact('totalKolekte', 'pendingLaporanCount', 'announcement'));
    }

    /**
     * Menampilkan dashboard untuk Sekretaris Paroki.
     * @return \Illuminate\View\View
     */
    public function sekretarisParokiDashboard()
    {
        $latestAnnouncement = Pengumuman::latest()->first();
        // Anda bisa menambahkan data lain yang relevan untuk sekretaris paroki
        // Misal: jumlah laporan yang sudah final, statistik, dll.
        return view('dashboard.sekretaris_paroki', compact('latestAnnouncement'));
    }

    /**
     * Menampilkan dashboard untuk Romo Paroki.
     * @return \Illuminate\View\View
     */
    public function romoParokiDashboard()
    {
        // Contoh data untuk Romo Paroki
        $laporanMenungguValidasiRomo = LaporanKolekte::where('status_romo_paroki', 'pending')->count();
        // Anda bisa menambahkan logika lain di sini

        return view('dashboard.romo_paroki', compact('laporanMenungguValidasiRomo'));
    }
}
