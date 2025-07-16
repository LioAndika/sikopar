<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanKolekte;
use App\Models\Stasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk debugging

class LaporanKolekteController extends Controller
{
    /**
     * Menampilkan form untuk menambah laporan kolekte.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $stasi = Stasi::all();
        } else {
            // Asumsi bendahara stasi hanya terkait dengan satu stasi
            $stasi = Stasi::where('id', $user->stasi_id)->get();
        }

        return view('laporan.create', compact('stasi'));
    }

    /**
     * Menyimpan laporan kolekte baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_kolekte' => 'required|date',
            'stasi_id' => 'required|exists:stasi,id',
            'jumlah_kolekte' => 'required|numeric|min:0',
        ]);

        $namaPengirim = Auth::user()->name;

        LaporanKolekte::create([
            'tanggal_kolekte' => $validatedData['tanggal_kolekte'],
            'nama_pengirim' => $namaPengirim,
            'stasi_id' => $validatedData['stasi_id'],
            'jumlah_kolekte' => $validatedData['jumlah_kolekte'],
            'created_by_user_id' => Auth::id(),
            'status_ketua_stasi' => 'pending',
            'status_bendahara_paroki' => 'pending',
            'status_romo_paroki' => 'pending',
            // Saat laporan baru dibuat, catatan revisi semua pihak pasti kosong
            'catatan_revisi_ketua_stasi' => null,
            'catatan_revisi_bendahara_paroki' => null,
            'catatan_revisi_romo_paroki' => null,
        ]);

        return redirect()->route('dashboard.bendahara-stasi')->with('success', 'Laporan kolekte berhasil ditambahkan.');
    }

    /**
     * Menampilkan daftar laporan kolekte untuk Bendahara Stasi.
     * Jika Super Admin, tampilkan semua laporan dari semua stasi.
     */
    public function indexBendahara()
    {
        $user = Auth::user();
        $query = LaporanKolekte::query();

        if (!$user->isSuperAdmin()) {
            $stasiIdBendahara = $user->stasi_id;
            if (!$stasiIdBendahara) {
                return redirect()->back()->with('error', 'Akun Bendahara Stasi Anda belum terhubung dengan stasi mana pun.');
            }
            $query->where('stasi_id', $stasiIdBendahara);
            // Bendahara Stasi melihat laporan yang statusnya 'pending' atau 'ditolak' di level Ketua Stasi atau Bendahara Paroki atau Romo Paroki
            $query->where(function($q) {
                $q->where('status_ketua_stasi', 'pending') // Menunggu validasi Ketua Stasi
                  ->orWhere('status_ketua_stasi', 'ditolak') // Ditolak oleh Ketua Stasi
                  ->orWhere('status_bendahara_paroki', 'ditolak') // Ditolak oleh Bendahara Paroki
                  ->orWhere('status_romo_paroki', 'ditolak'); // Ditolak oleh Romo Paroki (ini yang baru)
            });
        }

        $laporanKolektes = $query->with('stasi')
                                 ->orderBy('tanggal_kolekte', 'desc')
                                 ->get();

        $namaStasi = ($user->isSuperAdmin()) ? 'Semua Stasi' : (Stasi::find($user->stasi_id)->nama ?? 'Tidak Dikenal');


        return view('laporan.status_bendahara', compact('laporanKolektes', 'namaStasi'));
    }

    /**
     * Menampilkan daftar laporan yang sudah divalidasi Ketua Stasi DAN belum divalidasi Bendahara Paroki.
     * ATAU laporan yang divalidasi Bendahara Paroki tapi ditolak Romo Paroki.
     */
    public function indexBendaharaParoki()
    {
        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where(function($q) {
                                   // Laporan yang menunggu validasi Bendahara Paroki (masih pending)
                                   $q->where('status_bendahara_paroki', 'pending')
                                     // Laporan yang sudah divalidasi Bendahara Paroki TAPI ditolak oleh Romo Paroki
                                     ->orWhere(function($q2) {
                                         $q2->where('status_bendahara_paroki', 'divalidasi')
                                            ->where('status_romo_paroki', 'ditolak');
                                     });
                               });

        $laporanKolektes = $query->with('stasi')
                                 ->get();
        return view('bendahara_paroki.laporan.index', compact('laporanKolektes'));
    }

    /**
     * Validasi laporan kolekte oleh Bendahara Paroki.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\Response
     */
    public function validateLaporanBendaharaParoki(Request $request, LaporanKolekte $laporanKolekte)
    {
        $user = Auth::user();
        // Izinkan Bendahara Paroki (role_id 4) ATAU Super Admin untuk melakukan ini
        if (!$user->isSuperAdmin() && $user->role_id !== 4) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses untuk aksi ini.');
        }

        // Cek kondisi validasi:
        // 1. Status Bendahara Paroki masih 'pending' DAN Ketua Stasi sudah 'divalidasi'
        // 2. Atau status Bendahara Paroki sudah 'divalidasi' TAPI Romo Paroki 'ditolak' (untuk revisi ulang)
        if (($laporanKolekte->status_ketua_stasi === 'divalidasi' && $laporanKolekte->status_bendahara_paroki === 'pending') ||
            ($laporanKolekte->status_ketua_stasi === 'divalidasi' && $laporanKolekte->status_bendahara_paroki === 'divalidasi' && $laporanKolekte->status_romo_paroki === 'ditolak')) {

            $laporanKolekte->status_bendahara_paroki = 'divalidasi';
            $laporanKolekte->catatan_revisi_bendahara_paroki = null; // Reset catatan revisi Bendahara Paroki
            $laporanKolekte->status_romo_paroki = 'pending'; // Set status Romo Paroki ke pending untuk validasi ulang
            $laporanKolekte->catatan_revisi_romo_paroki = null; // Reset catatan Romo Paroki
            $laporanKolekte->save();

            return redirect()->route('bendahara-paroki.laporan.index')->with('success', 'Laporan kolekte berhasil divalidasi oleh Bendahara Paroki.');
        }

        return back()->with('error', 'Laporan tidak dapat divalidasi atau sudah diproses.');
    }

    /**
     * Tolak laporan kolekte oleh Bendahara Paroki.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\Response
     */
    public function rejectLaporanBendaharaParoki(Request $request, LaporanKolekte $laporanKolekte)
    {
        // Tangkap hasil validasi ke variabel $validatedData
        $validatedData = $request->validate([
            'catatan_revisi_bendahara_paroki' => 'required|string|min:10|max:500',
        ]);

        $user = Auth::user();
        // Izinkan Bendahara Paroki (role_id 4) ATAU Super Admin untuk melakukan ini
        if (!$user->isSuperAdmin() && $user->role_id !== 4) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses untuk aksi ini.');
        }

        if ($laporanKolekte->status_ketua_stasi === 'divalidasi' && $laporanKolekte->status_bendahara_paroki === 'pending') {
            $laporanKolekte->status_bendahara_paroki = 'ditolak';
            // Ketika ditolak, set catatan revisi bendahara paroki dari $validatedData
            $laporanKolekte->catatan_revisi_bendahara_paroki = $validatedData['catatan_revisi_bendahara_paroki'];
            // Penting: Ketika bendahara menolak, laporan ini kembali ke ketua stasi.
            // Maka, status ketua stasi harus diubah menjadi 'ditolak' atau 'pending'
            // agar ketua stasi bisa melihat dan merevisi.
            $laporanKolekte->status_ketua_stasi = 'ditolak'; // Mengembalikan ke ketua stasi
            $laporanKolekte->catatan_revisi_ketua_stasi = null; // Opsional: Bersihkan catatan ketua stasi sebelumnya

            // Reset status Romo Paroki dan catatannya jika ditolak di tahap ini
            $laporanKolekte->status_romo_paroki = 'pending'; // Pastikan tidak null, kembali ke pending
            $laporanKolekte->catatan_revisi_romo_paroki = null; // Kosongkan catatan romo
            $laporanKolekte->save();

            return redirect()->route('bendahara-paroki.laporan.index')->with('success', 'Laporan kolekte berhasil ditolak oleh Bendahara Paroki dan dikirim kembali ke Ketua Stasi untuk revisi.');
        }

        return back()->with('error', 'Laporan tidak dapat ditolak atau sudah diproses.');
    }

    public function indexMenungguRomoParoki()
    {
        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where('status_bendahara_paroki', 'divalidasi')
                               ->where('status_romo_paroki', 'pending');

        $laporanKolektes = $query->with('stasi')
                                 ->get();

        // Menggunakan view yang benar untuk Bendahara Paroki melihat yang menunggu Romo Paroki
        return view('bendahara_paroki.laporan.menunggu_romo', compact('laporanKolektes'));
    }

    public function indexRomoParoki()
    {
        // Romo Paroki hanya melihat laporan yang sudah divalidasi Ketua Stasi DAN Bendahara Paroki
        // DAN status_romo_paroki masih 'pending'
        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where('status_bendahara_paroki', 'divalidasi')
                               ->where('status_romo_paroki', 'pending'); // Hanya tampilkan yang pending untuk Romo

        $laporanKolektes = $query->with('stasi')
                                 ->get();

        return view('romo_paroki.laporan.index', compact('laporanKolektes'));
    }

    /**
     * Validasi laporan kolekte oleh Romo Paroki.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\Response
     */
    public function validateLaporanRomoParoki(Request $request, LaporanKolekte $laporanKolekte)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && $user->role_id !== 6) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses untuk aksi ini.');
        }

        if ($laporanKolekte->status_ketua_stasi === 'divalidasi' &&
            $laporanKolekte->status_bendahara_paroki === 'divalidasi' &&
            $laporanKolekte->status_romo_paroki === 'pending') {

            $laporanKolekte->status_romo_paroki = 'divalidasi';
            // Saat Romo Paroki memvalidasi, catatan revisi Romo Paroki direset
            $laporanKolekte->catatan_revisi_romo_paroki = null;
            $laporanKolekte->save();

            return redirect()->route('romo-paroki.laporan.index')->with('success', 'Laporan kolekte berhasil divalidasi oleh Romo Paroki.');
        }

        return back()->with('error', 'Laporan tidak dapat divalidasi atau sudah diproses.');
    }

    /**
     * Tolak laporan kolekte oleh Romo Paroki.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKolekte  $laporanKolekte
     * @return \Illuminate\Http\Response
     */
    public function rejectLaporanRomoParoki(Request $request, LaporanKolekte $laporanKolekte)
    {
        $validatedData = $request->validate([
            'catatan_revisi_romo_paroki' => 'required|string|min:10|max:500',
        ]);

        $user = Auth::user();
        if (!$user->isSuperAdmin() && $user->role_id !== 6) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses untuk aksi ini.');
        }

        // Pastikan laporan berada pada status yang benar untuk ditolak oleh Romo
        if ($laporanKolekte->status_ketua_stasi === 'divalidasi' &&
            $laporanKolekte->status_bendahara_paroki === 'divalidasi' &&
            $laporanKolekte->status_romo_paroki === 'pending') { // Hanya tolak jika statusnya masih pending Romo

            $laporanKolekte->status_romo_paroki = 'ditolak'; // Ubah status Romo Paroki menjadi 'ditolak'
            $laporanKolekte->catatan_revisi_romo_paroki = $validatedData['catatan_revisi_romo_paroki']; // Simpan catatan revisi

            // Ketika Romo menolak, laporan ini kembali ke Bendahara Paroki.
            // Tidak perlu mengubah status_bendahara_paroki menjadi 'pending' atau 'ditolak'
            // karena logika di `indexBendaharaParoki` sudah menangani kasus
            // di mana `status_romo_paroki` adalah 'ditolak'.
            // Biarkan status bendahara paroki tetap 'divalidasi'.
            // Dengan begitu, Bendahara Paroki akan melihat laporan ini untuk direvisi.

            $laporanKolekte->save(); // Simpan perubahan ke database

            // Setelah ditolak, Romo Paroki seharusnya tidak lagi melihat laporan ini di daftar 'pending'
            return redirect()->route('romo-paroki.laporan.index')->with('success', 'Laporan kolekte berhasil ditolak oleh Romo Paroki dan dikirim kembali ke Bendahara Paroki untuk revisi.');
        }

        return back()->with('error', 'Laporan tidak dapat ditolak karena statusnya tidak sesuai atau sudah diproses.');
    }

    /**
     * Menampilkan laporan kolekte yang sudah divalidasi final khusus untuk Bendahara Paroki.
     * @return \Illuminate\View\View
     */
    public function finalReportBendaharaParoki()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();

        $laporanKolektes = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                                         ->where('status_bendahara_paroki', 'divalidasi')
                                         ->where('status_romo_paroki', 'divalidasi')
                                         ->where('tanggal_kolekte', '>=', $sevenDaysAgo)
                                         ->with('stasi')
                                         ->orderBy('tanggal_kolekte', 'desc')
                                         ->get();
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('laporan.final_bendahara_paroki', compact('laporanKolektes', 'totalKolekte'));
    }

    /**
     * Menampilkan laporan kolekte yang sudah divalidasi final khusus untuk Romo Paroki.
     * @return \Illuminate\View\View
     */
    public function finalReportRomoParoki()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();

        $laporanKolektes = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                                         ->where('status_bendahara_paroki', 'divalidasi')
                                         ->where('status_romo_paroki', 'divalidasi')
                                         ->where('tanggal_kolekte', '>=', $sevenDaysAgo)
                                         ->with('stasi')
                                         ->orderBy('tanggal_kolekte', 'desc')
                                         ->get();
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('laporan.final_romo_paroki', compact('laporanKolektes', 'totalKolekte'));
    }

    /**
     * Menampilkan laporan kolekte yang sudah divalidasi final khusus untuk Sekretaris Paroki.
     * @return \Illuminate\View\View
     */
    public function finalReportSekretarisParoki()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();

        $laporanKolektes = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                                         ->where('status_bendahara_paroki', 'divalidasi')
                                         ->where('status_romo_paroki', 'divalidasi')
                                         ->where('tanggal_kolekte', '>=', $sevenDaysAgo)
                                         ->with('stasi')
                                         ->orderBy('tanggal_kolekte', 'desc')
                                         ->get();
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('laporan.final_sekretaris_paroki', compact('laporanKolektes', 'totalKolekte'));
    }

    /**
     * Menampilkan riwayat laporan kolekte yang sudah final untuk Bendahara Paroki dan Super Admin.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function historyBendaharaParoki(Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin() && !$user->hasRole('bendahara-paroki')) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat riwayat laporan ini.');
        }

        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where('status_bendahara_paroki', 'divalidasi')
                               ->where('status_romo_paroki', 'divalidasi');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pengirim', 'like', $searchTerm)
                  ->orWhereHas('stasi', function ($qStasi) use ($searchTerm) {
                      $qStasi->where('nama', 'like', $searchTerm);
                  });
            });
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('tanggal_kolekte', '>=', $request->start_date);
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('tanggal_kolekte', '<=', $request->end_date);
        }

        $stasiOptions = Stasi::orderBy('nama')->get();
        if ($request->has('stasi_id') && !empty($request->stasi_id)) {
            $query->where('stasi_id', $request->stasi_id);
        }

        $laporanKolektes = $query->with('stasi')
                                 ->orderBy('tanggal_kolekte', 'desc')
                                 ->paginate(15);
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('history.history_bendahara_paroki', compact('laporanKolektes', 'totalKolekte', 'stasiOptions'));
    }

    /**
     * Menampilkan riwayat laporan kolekte yang sudah final untuk Romo Paroki dan Super Admin.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function historyRomoParoki(Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin() && !$user->hasRole('romo-paroki')) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat riwayat laporan ini.');
        }

        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where('status_bendahara_paroki', 'divalidasi')
                               ->where('status_romo_paroki', 'divalidasi');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pengirim', 'like', $searchTerm)
                  ->orWhereHas('stasi', function ($qStasi) use ($searchTerm) {
                      $qStasi->where('nama', 'like', $searchTerm);
                  });
            });
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('tanggal_kolekte', '>=', $request->start_date);
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('tanggal_kolekte', '<=', $request->end_date);
        }
        $stasiOptions = Stasi::orderBy('nama')->get();
        if ($request->has('stasi_id') && !empty($request->stasi_id)) {
            $query->where('stasi_id', $request->stasi_id);
        }

        $laporanKolektes = $query->with('stasi')
                                 ->orderBy('tanggal_kolekte', 'desc')
                                 ->paginate(15);
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('history.history_romo_paroki', compact('laporanKolektes', 'totalKolekte', 'stasiOptions'));
    }

    /**
     * Menampilkan riwayat laporan kolekte yang sudah final untuk Sekretaris Paroki dan Super Admin.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function historySekretarisParoki(Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin() && !$user->hasRole('sekretaris-paroki')) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat riwayat laporan ini.');
        }

        $query = LaporanKolekte::where('status_ketua_stasi', 'divalidasi')
                               ->where('status_bendahara_paroki', 'divalidasi')
                               ->where('status_romo_paroki', 'divalidasi');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pengirim', 'like', $searchTerm)
                  ->orWhereHas('stasi', function ($qStasi) use ($searchTerm) {
                      $qStasi->where('nama', 'like', $searchTerm);
                  });
            });
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('tanggal_kolekte', '>=', $request->start_date);
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('tanggal_kolekte', '<=', $request->end_date);
        }
        $stasiOptions = Stasi::orderBy('nama')->get();
        if ($request->has('stasi_id') && !empty($request->stasi_id)) {
            $query->where('stasi_id', $request->stasi_id);
        }

        $laporanKolektes = $query->with('stasi')
                                 ->orderBy('tanggal_kolekte', 'desc')
                                 ->paginate(15);
        $totalKolekte = $laporanKolektes->sum('jumlah_kolekte');

        return view('history.history_sekretaris_paroki', compact('laporanKolektes', 'totalKolekte', 'stasiOptions'));
    }
}