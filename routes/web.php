<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanKolekteController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KetuaStasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StasiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SekretarisParokiController;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController; // <--- PASTIKAN INI ADA DAN TIDAK DUPLIKAT

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| dimuat oleh RouteServiceProvider dalam grup yang berisi middleware "web".
| Sekarang buatlah sesuatu yang hebat!
|
*/

// Rute untuk Halaman Landing
Route::get('/', function () {
    if (Auth::check()) {
        return (new AuthController())->redirectToDashboard(Auth::user());
    }
    return view('landing'); // Ini adalah landing page Anda saat ini
})->name('landing'); // Tetap gunakan 'landing' sebagai nama untuk halaman utama publik Anda

// Rute Otentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Rute logout default Laravel
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Grup rute yang memerlukan otentikasi untuk semua pengguna yang login
Route::middleware(['auth'])->group(function () {

    // --- Rute Dashboard Terpusat berdasarkan Peran ---
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Menggunakan 'role.or.superadmin' agar Super Admin dapat mengakses semua dashboard
        Route::get('/super-admin', [DashboardController::class, 'superAdminDashboard'])->name('super-admin')->middleware('role.or.superadmin:super-admin');
        Route::get('/bendahara-stasi', [DashboardController::class, 'bendaharaStasiDashboard'])->name('bendahara-stasi')->middleware('role.or.superadmin:bendahara-stasi');
        Route::get('/ketua-stasi', [DashboardController::class, 'ketuaStasiDashboard'])->name('ketua-stasi')->middleware('role.or.superadmin:ketua-stasi');
        Route::get('/bendahara-paroki', [DashboardController::class, 'bendaharaParokiDashboard'])->name('bendahara-paroki')->middleware('role.or.superadmin:bendahara-paroki');
        Route::get('/sekretaris-paroki', [DashboardController::class, 'sekretarisParokiDashboard'])->name('sekretaris-paroki')->middleware('role.or.superadmin:sekretaris-paroki');
        Route::get('/romo-paroki', [DashboardController::class, 'romoParokiDashboard'])->name('romo-paroki')->middleware('role.or.superadmin:romo-paroki');

        // Dashboard umum sebagai fallback
        Route::get('/', function () {
            return view('dashboard.general');
        })->name('general');
    });

    // --- FITUR BERDASARKAN PERAN ---

    // Grup Super Admin
    Route::prefix('super-admin')->name('super-admin.')->middleware('role.or.superadmin:super-admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('stasi', StasiController::class);

        // Rute untuk Super Admin kembali ke dashboard utamanya dari peran lain
        Route::post('/return-to-dashboard', function(Request $request) {
            // Pastikan pengguna adalah super-admin dan sedang login
            if (Auth::user() && Auth::user()->hasRole('super-admin')) {
                // Tidak perlu logout, cukup redirect
                return redirect()->route('dashboard.super-admin');
            }
            // Jika tidak memenuhi syarat, lakukan logout penuh (ini skenario tidak biasa)
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landing');
        })->name('return-to-dashboard'); // Nama rute yang jelas
    });

    // Grup Bendahara Stasi
    Route::middleware('role.or.superadmin:bendahara-stasi')->group(function () {
        Route::get('/laporan-kolekte/create', [LaporanKolekteController::class, 'create'])->name('laporan.create');
        Route::post('/laporan-kolekte', [LaporanKolekteController::class, 'store'])->name('laporan.store');
        Route::get('/laporan-kolekte/status', [LaporanKolekteController::class, 'indexBendahara'])->name('laporan.status.bendahara');
    });

    // Grup Ketua Stasi
    Route::middleware('role.or.superadmin:ketua-stasi')->group(function () {
        Route::prefix('ketua-stasi')->name('ketua-stasi.')->group(function () {
            Route::get('/laporan-validasi', [KetuaStasiController::class, 'index'])->name('laporan.index');
            Route::post('/laporan/{laporanKolekte}/validasi', [KetuaStasiController::class, 'validateLaporan'])->name('laporan.validate');
            Route::post('/laporan/{laporanKolekte}/tolak', [KetuaStasiController::class, 'rejectLaporan'])->name('laporan.reject');
        });
    });

    // Grup Bendahara Paroki
    Route::middleware('role.or.superadmin:bendahara-paroki')->group(function () {
        Route::prefix('bendahara-paroki')->name('bendahara-paroki.')->group(function () {
            Route::get('/laporan-divalidasi', [LaporanKolekteController::class, 'indexBendaharaParoki'])->name('laporan.index');
            Route::post('/laporan/{laporanKolekte}/validasi', [LaporanKolekteController::class, 'validateLaporanBendaharaParoki'])->name('laporan.validasi');
            Route::post('/laporan/{laporanKolekte}/tolak', [LaporanKolekteController::class, 'rejectLaporanBendaharaParoki'])->name('laporan.tolak');
            Route::get('/laporan-menunggu-romo', [LaporanKolekteController::class, 'indexMenungguRomoParoki'])->name('laporan.menunggu-romo');
            Route::get('/laporan-final', [LaporanKolekteController::class, 'finalReportBendaharaParoki'])->name('laporan.final');
            Route::get('/laporan/history', [LaporanKolekteController::class, 'historyBendaharaParoki'])->name('laporan.history.bendahara-paroki');
        });
    });

    // Grup Romo Paroki
    Route::middleware('role.or.superadmin:romo-paroki')->group(function () {
        Route::prefix('romo-paroki')->name('romo-paroki.')->group(function () {
            Route::get('/laporan', [LaporanKolekteController::class, 'indexRomoParoki'])->name('laporan.index');
            Route::post('/laporan/{laporanKolekte}/validasi', [LaporanKolekteController::class, 'validateLaporanRomoParoki'])->name('laporan.validasi');
            Route::post('/laporan/{laporanKolekte}/tolak', [LaporanKolekteController::class, 'rejectLaporanRomoParoki'])->name('laporan.tolak');
            Route::get('/laporan-final', [LaporanKolekteController::class, 'finalReportRomoParoki'])->name('laporan.final');
            Route::get('/laporan/history', [LaporanKolekteController::class, 'historyRomoParoki'])->name('laporan.history.romo-paroki');
        });
    });

    // Grup Sekretaris Paroki
    Route::middleware('role.or.superadmin:sekretaris-paroki')->group(function () {
        Route::prefix('sekretaris-paroki')->name('sekretaris-paroki.')->group(function () {
            Route::get('/pengumuman/manage', [SekretarisParokiController::class, 'dashboard'])->name('pengumuman.manage');
            Route::put('/pengumuman/update', [SekretarisParokiController::class, 'updateAnnouncement'])->name('pengumuman.update');
            Route::get('/laporan-final', [LaporanKolekteController::class, 'finalReportSekretarisParoki'])->name('laporan.final');
            Route::get('/laporan/history', [LaporanKolekteController::class, 'historySekretarisParoki'])->name('laporan.history.sekretaris-paroki');
        });
    });

    // Rute Global untuk Pengumuman (jika ada, biarkan di sini)
    // Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
});

// --- Rute Halaman Publik (yang akan diakses dari navbar) ---
// Pastikan rute ini DILUAR dari grup middleware 'auth' agar bisa diakses tanpa login.
Route::get('/profil-gereja', [PageController::class, 'profilGereja'])->name('profil-gereja');
Route::get('/kegiatan-agenda', [PageController::class, 'kegiatanAgenda'])->name('kegiatan-agenda');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/informasi', [PageController::class, 'informasi'])->name('informasi');
// Jika Anda ingin "Tentang Gereja" di footer mengarah ke halaman yang berbeda dari "Profil Gereja",
// Anda bisa menambahkan rute terpisah di sini:
// Route::get('/tentang-gereja', [PageController::class, 'tentangGereja'])->name('tentang-gereja');