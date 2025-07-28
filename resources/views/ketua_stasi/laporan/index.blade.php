<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Laporan Kolekte - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Kustom untuk efek hover yang halus pada kartu */
        .card-hover-effect {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom sidebar active state */
        .sidebar-item.active {
            background-color: #3B82F6; /* Biru yang menarik untuk aktif (blue-500) */
            color: white !important; /* Ensure text is white for active item */
            font-weight: 600;
        }
        /* Ensure non-active sidebar items have visible text */
        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            color: #4B5563; /* Gray-700 untuk teks default */
        }
        .sidebar-item:not(.active):hover {
            background-color: #E0E7FF; /* Light blue on hover for non-active items (blue-100) */
            color: #2563EB; /* Darker blue on hover (blue-600) */
        }
        .sidebar-item svg {
            margin-right: 0.75rem;
            color: currentColor;
        }
        /* Style for SIKOPAR text and logo to make it black */
        .sidebar-brand {
            color: #1F2937; /* Darker gray for SIKOPAR text (gray-800) */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-bottom: 1px solid #E5E7EB; /* border-gray-200 */
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
        .sidebar-brand img {
            height: 2.5rem;
            width: 2.5rem;
            margin-right: 0.75rem;
            border-radius: 9999px;
        }

        /* Sidebar background */
        .sidebar-container {
            background-color: white;
            color: #334155;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Wrapper */
        .table-wrapper {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
            overflow: hidden;
        }

        /* Modern Table Styling */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .modern-table thead th {
            background-color: #3B82F6; /* Biru untuk header tabel (blue-500) */
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            padding: 1rem 1.5rem;
            text-align: left;
        }
        .modern-table tbody td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #E5E7EB; /* border-gray-200 */
            font-size: 0.9375rem;
            color: #4B5563; /* gray-700 */
        }
        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }
        .modern-table tbody tr:hover {
            background-color: #F3F4F6; /* Light gray on hover (gray-100) */
        }
        /* Status badge styling */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .status-yellow { /* Pending - tetap kuning untuk menarik perhatian */
            background-color: #FEF3C7; /* yellow-100 */
            color: #B45309; /* yellow-800 */
        }
        .status-green { /* Divalidasi - tetap hijau sebagai indikator positif */
            background-color: #D1FAE5; /* green-100 */
            color: #065F46; /* green-800 */
        }
        .status-red { /* Ditolak - tetap merah sebagai indikator negatif */
            background-color: #FEE2E2; /* red-100 */
            color: #991B1B; /* red-800 */
        }
        /* Status for Bendahara Paroki / Romo Paroki - Pending */
        .status-blue { /* Menunggu Konfirmasi di proses lanjutan */
            background-color: #DBEAFE; /* blue-100 */
            color: #1D4ED8; /* blue-700 */
        }
        .status-secondary { /* Untuk status tidak diketahui */
             background-color: #E5E7EB; /* gray-200 */
            color: #4B5563; /* gray-700 */
        }

        /* Action Buttons - New Colors */
        .action-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .action-button.validate {
            background-color: #10B981; /* Emerald green for positive action (emerald-500) */
            color: white;
        }
        .action-button.validate:hover {
            background-color: #059669; /* Darker emerald on hover (emerald-600) */
            transform: translateY(-1px);
        }
        .action-button.reject {
            background-color: #EF4444; /* Red for negative action (red-500) */
            color: white;
        }
        .action-button.reject:hover {
            background-color: #DC2626; /* Darker red on hover (red-600) */
            transform: translateY(-1px);
        }
        .action-button + .action-button {
            margin-left: 0.5rem;
        }


        /* Mobile-specific styles */
        @media (max-width: 767px) {
            .sidebar-container {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 200px;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 21;
                box-shadow: 2px 0 5px rgba(0,0,0,0.2);
            }
            .sidebar-container.active {
                transform: translateX(0);
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 20;
                display: none;
            }
            .overlay.active {
                display: block;
            }
            body {
                padding-top: 3rem;
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10;
                background-color: white;
                padding: 0.5rem 0.75rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #E5E7EB;
                margin-bottom: 0.75rem;
            }
            header h1 {
                font-size: 1rem;
                font-weight: bold;
                color: #374151;
            }
            .mobile-welcome {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .mobile-avatar {
                width: 1.8rem;
                height: 1.8rem;
                background-color: #3B82F6;
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.6rem;
                font-weight: bold;
                text-transform: uppercase;
            }
            header .desktop-welcome {
                display: none;
            }
            #burger-btn {
                z-index: 22;
            }
            .main-content {
                padding-top: 0;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
                margin-top:1.5rem;
            }
            .sidebar-item {
                font-size: 0.85rem;
                padding: 0.6rem 1rem;
            }

            .sidebar-brand img {
                height: 2rem;
                width: 2rem;
                margin-right: 0.5rem;
            }
            .sidebar-brand {
                font-size: 1.5rem;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 1rem !important;
            }
            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .modern-table {
                min-width: 750px;
            }
            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.5rem 0.75rem;
                font-size: 0.55rem;

            }
            .modern-table thead th.text-right{
                text-align: center;
            }
            .modern-table thead th.text-center{
                text-align: center;
            }

            .status-badge {
                padding: 0.15rem 0.5rem;
                font-size: 0.65rem;
            }
            .action-button {
                padding: 0.3rem 0.6rem;
                font-size: 0.7rem;
            }
            .action-button + .action-button {
                margin-left: 0.3rem;
            }
        }

        /* Desktop specific styles - reset mobile overrides */
        @media (min-width: 768px) {
            body {
                padding-top: 0 !important;
            }
            header {
                position: relative !important;
                padding: 0.75rem 1.5rem !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important;
            }
            header h1 {
                font-size: 1.75rem !important;
            }
            header .mobile-welcome {
                display: none !important;
            }
            header .desktop-welcome {
                display: flex !important;
                align-items: center;
            }
            header .desktop-welcome span {
                font-size: 0.95rem;
            }
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 2rem !important;
            }
            .modern-table {
                min-width: unset;
            }
            .modern-table thead th {
                padding: 1rem 1.5rem;
                font-size: 0.875rem;
                text-align: left;
            }

            .modern-table thead th.text-right {
                text-align: right;
                padding-right: 1.5rem;
                padding-left: 1.5rem;
            }
            .modern-table thead th.text-center {
                text-align: center;
                padding-right: 1.5rem;
                padding-left: 1.5rem;
            }


            .modern-table tbody td {
                padding: 1rem 1.5rem;
                font-size: 0.9375rem;
                text-align: left;
            }

            .py-3.px-6.text-center.flex.items-center.justify-center.space-x-3 {
                justify-content: center;
                padding-right: 1.5rem;
                padding-left: 1.5rem;
            }

            .action-button {
                padding: 0.5rem 1rem;
                margin-right: 0;
                font-size: 0.875rem;
            }
            .action-button + .action-button {
                margin-left: 0.75rem;
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">

    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.ketua-stasi') }}" class="sidebar-item {{ Request::routeIs('dashboard.ketua-stasi') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('ketua-stasi.laporan.index') }}" class="sidebar-item {{ Request::routeIs('ketua-stasi.laporan.index') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Validasi Laporan Kolekte
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="sidebar-item hover:bg-red-700 mt-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </div>

    <div class="flex-grow p-6 md:p-10 main-content">
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-4xl font-extrabold text-gray-800">
                    Validasi Laporan Kolekte {{ $namaStasi }}
                </h1>
            </div>
            {{-- Bagian ini dikosongkan karena tidak ada welcome avatar di header desktop pada contoh awal --}}
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Error Validasi!</strong>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tabel Laporan Menunggu Validasi --}}
        <div class="bg-white p-8 rounded-xl shadow-md mt-5 card-hover-effect">
            <h2 class=" font-semibold text-gray-800 mb-6 border-b pb-3 border-gray-200">Laporan Menunggu Validasi Ketua Stasi</h2>

            {{-- Menggunakan $laporanKolektesPending --}}
            @if ($laporanKolektesPending->isEmpty())
                <p class="text-gray-600 text-lg text-center py-4">Tidak ada laporan kolekte yang menunggu validasi dari {{ $namaStasi }}.</p>
            @else
                <div class="table-wrapper">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">Tanggal Kolekte</th>
                                <th class="py-3 px-6 text-left">Pengirim</th>
                                <th class="py-3 px-6 text-right">Jumlah Kolekte</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Aksi</th> {{-- Align center for buttons --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Menggunakan $laporanKolektesPending --}}
                            @foreach ($laporanKolektesPending as $laporan)
                                <tr>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $laporan->tanggal_kolekte->format('d M Y') }}</td>
                                    <td class="py-3 px-6 text-left">{{ $laporan->nama_pengirim }}</td>
                                    <td class="py-3 px-6 text-right">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="status-badge status-yellow">
                                            {{ ucfirst(str_replace('_', ' ', $laporan->status_ketua_stasi)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center flex items-center justify-center space-x-3">
                                        <form action="{{ route('ketua-stasi.laporan.validate', $laporan->id) }}" method="POST" class="inline" onsubmit="return confirmValidation()">
                                            @csrf
                                            <button type="submit" class="action-button validate">
                                                Validasi
                                            </button>
                                        </form>
                                        <button type="button" onclick="showRejectModal({{ $laporan->id }})" class="action-button reject">
                                            Tolak
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Tabel Laporan Status Bendahara Paroki & Romo Paroki (BARU) --}}
        <div class="bg-white p-8 rounded-xl shadow-md mt-8 card-hover-effect">
            <h2 class="font-semibold text-gray-800 mb-6 border-b pb-3 border-gray-200">Status Laporan Setelah Validasi Ketua Stasi (Proses Bendahara Paroki & Romo Paroki)</h2>

            {{-- Menggunakan $laporanKolektesProcessed --}}
            @if ($laporanKolektesProcessed->isEmpty())
                <p class="text-gray-600 text-lg text-center py-4">Tidak ada laporan kolekte yang sudah divalidasi oleh Anda yang sedang diproses Bendahara Paroki atau Romo Paroki.</p>
            @else
                <div class="table-wrapper">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">Tanggal Kolekte</th>
                                <th class="py-3 px-6 text-left">Pengirim</th>
                                <th class="py-3 px-6 text-right">Jumlah Kolekte</th>
                                <th class="py-3 px-6 text-center">Status Bendahara Paroki</th>
                                <th class="py-3 px-6 text-left">Catatan Revisi Bendahara</th>
                                <th class="py-3 px-6 text-center">Status Romo Paroki</th>
                                <th class="py-3 px-6 text-left">Catatan Revisi Romo</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Menggunakan $laporanKolektesProcessed --}}
                            @foreach ($laporanKolektesProcessed as $laporan)
                                <tr>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $laporan->tanggal_kolekte->format('d M Y') }}</td>
                                    {{-- Menggunakan createdBy relasi untuk nama user, fallback ke nama_pengirim --}}
                                    <td class="py-3 px-6 text-left">{{ $laporan->createdBy->name ?? $laporan->nama_pengirim ?? 'User Tidak Dikenal' }}</td>
                                    <td class="py-3 px-6 text-right">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if($laporan->status_bendahara_paroki == 'pending')
                                            <span class="status-badge status-blue">Menunggu Konfirmasi</span>
                                        @elseif($laporan->status_bendahara_paroki == 'divalidasi')
                                            <span class="status-badge status-green">Sudah Divalidasi</span>
                                        @elseif($laporan->status_bendahara_paroki == 'ditolak')
                                            <span class="status-badge status-red">Ditolak</span>
                                        @else
                                            <span class="status-badge status-secondary">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $laporan->catatan_revisi_bendahara_paroki ?? '-' }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if($laporan->status_romo_paroki == 'pending')
                                            <span class="status-badge status-blue">Menunggu Konfirmasi</span>
                                        @elseif($laporan->status_romo_paroki == 'divalidasi')
                                            <span class="status-badge status-green">Sudah Divalidasi</span>
                                        @elseif($laporan->status_romo_paroki == 'ditolak')
                                            <span class="status-badge status-red">Ditolak</span>
                                        @else
                                            <span class="status-badge status-secondary">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $laporan->catatan_revisi_romo_paroki ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

    {{-- Modal penolakan --}}
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="relative p-8 border rounded-xl shadow-xl bg-white w-full max-w-md mx-4 my-8">
            <div class="text-center">
                <h3 class="text-2xl leading-6 font-semibold text-gray-900 mb-4">Tolak Laporan Kolekte</h3>
                <div class="px-2 py-3">
                    <form id="rejectForm" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="catatan_revisi" class="block text-gray-700 text-sm font-semibold mb-2 text-left">Catatan Penolakan:</label>
                           <textarea name="catatan_revisi_ketua_stasi" id="catatan_revisi" rows="4" required
    class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
    @error('catatan_revisi_ketua_stasi') border-red-500 ring-red-500 @enderror"
    placeholder="Masukkan alasan penolakan..."></textarea>
                            @error('catatan_revisi')
                                <p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="hideRejectModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                                Batal
                            </button>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                                Kirim Penolakan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });

        function showRejectModal(laporanId) {
            const form = document.getElementById('rejectForm');
            form.action = `/ketua-stasi/laporan/${laporanId}/tolak`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('catatan_revisi').value = '';
            const errorElement = document.querySelector('#catatan_revisi + p.text-red-500');
            if (errorElement) {
                errorElement.remove();
            }
            const textarea = document.getElementById('catatan_revisi');
            textarea.classList.remove('border-red-500', 'ring-red-500');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target == modal) {
                hideRejectModal();
            }
        }

        // Fungsi baru untuk konfirmasi validasi
        function confirmValidation() {
            return confirm("Apakah Anda yakin ingin memvalidasi laporan kolekte ini?");
        }
    </script>
</body>
</html>