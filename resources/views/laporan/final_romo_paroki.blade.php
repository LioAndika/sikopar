<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kolekte Final Romo - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @media screen {
                .knowing-text {
                display: none !important;
                }}
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                font-size: 8pt;
                color: #000;
            }
            .knowing-text {
            display: block !important;
            }
            .no-print {
                display: none !important;
            }
            .sidebar, header {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 1cm !important;
                box-sizing: border-box;
            }

            /* Print-specific header and footer */
            .print-header {
                display: flex !important; /* Menggunakan flexbox untuk tata letak */
                align-items: center; /* Pusatkan secara vertikal */
                justify-content: flex-start; /* Sejajarkan ke kiri */
                margin-bottom: 20px;
                padding-bottom: 10px; /* Tambahkan sedikit padding di bawah garis */
                border-bottom: 0.5px solid #ccc; /* Pindahkan garis HR ke parent */
            }
            .print-header img {
                max-width: 100px;
                height: auto;
                margin-right: 20px; /* Beri jarak antara logo dan teks */
                margin-bottom: 0; /* Pastikan margin-bottom tidak ada */
            }
            .print-header .header-content { /* Wadah baru untuk teks kop surat */
                text-align: center; /* Teks rata kiri */
                margin-left:50px;
            }
            .print-header h1 {
                font-size: 14pt;
                font-weight: bold;
                margin: 0;
                color: #000;
            }
            .print-header p {
                font-size: 8pt;
                margin: 0;
                color: #000;
            }
            .print-header hr {
                display: none; /* Sembunyikan HR lama karena sudah dipindah ke parent .print-header */
            }

            .print-footer {
                display: flex !important;
                justify-content: space-around;
                margin-top: 40px; /* Jarak dari tabel ke bagian tanda tangan, disesuaikan jika ada 'Mengetahui' di atasnya */
                width: 100%;
            }
            .print-footer .signer-block {
                text-align: center;
                flex: 1;
            }
            .print-footer .signer-name {
                font-weight: bold;
                text-decoration: underline;
                display: block;
                margin-top: 5px;
                color: #000;
            }
            .print-footer .signer-title {
                display: block;
                font-size: 8pt;
                color: #000;
            }
            .print-date {
                text-align: right;
                margin-bottom: 8px; /* Jarak antara tanggal dan tanda tangan */
                font-size: 8.5pt;
                color: #000;
                width: 100%;
                display: block;
            }
            /* Menyesuaikan posisi teks tanggal di dalam .print-footer */
            .print-footer .signer-date {
                text-align: right;
                margin-bottom: 5px; /* Jarak antara tanggal dan nama di dalam blok tanda tangan */
                font-size: 8pt;
            }
            /* Style untuk ruang tanda tangan digital */
            .signature-space {
                display: block;
                width: 150px; /* Lebar ruang tanda tangan */
                height: 70px;  /* Tinggi ruang tanda tangan */
                border: 1px dashed #ccc; /* Border putus-putus untuk menunjukkan area */
                margin: 10px auto 5px auto; /* Margin atas, tengah horizontal, margin bawah */
                background-color: #f9f9f9; /* Warna latar belakang ringan */
                color: #888;
                font-size: 7pt;
                line-height: 70px; /* Vertically center text */
                text-align: center;
                overflow: hidden; /* Pastikan konten tidak meluber */
            }

            /* Gaya untuk teks "Mengetahui" di atas tanda tangan */
            .knowing-text {
                text-align: center;
                font-weight: bold;
                font-size: 9pt;
                margin-top: 20px; /* Jarak dari tanggal ke teks "Mengetahui" */
                margin-bottom: 10px; /* Jarak dari teks "Mengetahui" ke blok tanda tangan */
                display: block;
                width: 100%;
            }


            /* --- Plain Table Print Styles (Optimized for balance and border integrity) --- */
            .card-hover-effect {
                box-shadow: none !important;
                transform: none !important;
                border: none !important;
                padding: 0 !important;
                background-color: transparent !important;
            }

            table {
                width: 100%;
                border-collapse: collapse; /* Pastikan border menyatu dengan rapi */
                margin-top: 0;
                page-break-inside: auto;
                background-color: transparent !important;
            }
            thead {
                display: table-header-group;
                background-color: transparent !important;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
                background-color: transparent !important;
            }
            th, td {
                border: 1px solid #000 !important; /* Border hitam solid untuk semua sel */
                padding: 4px 6px;
                text-align: left;
                color: #000 !important;
                background-color: transparent !important;
                font-size: 7.5pt;
                vertical-align: top;
                white-space: normal;
            }
            th {
                font-weight: bold !important;
                text-transform: none !important;
            }

            .total-row td {
                font-weight: bold !important;
                background-color: transparent !important;
                border-top: 2px solid #000 !important; /* Batas atas lebih tebal untuk total */
            }
            /* Penyesuaian khusus untuk sel total */
            .total-row td:nth-child(1) {
                text-align: right; /* "Total Keseluruhan Kolekte:" rata kanan */
                padding-right: 10px; /* Memberi sedikit ruang */
                border-right: 1px solid #000 !important; /* Pastikan ada border pemisah */
            }
            .total-row td:nth-child(2) { /* Kolom Jumlah Kolekte */
                text-align: right;
                border-left: 1px solid #000 !important; /* Pastikan ada border pemisah */
            }


            /* ========================================================= */
            /* Perubahan KHUSUS untuk tampilan CETAK: */
            /* Sembunyikan kolom Status di THEAD (header tabel) */
            th:nth-child(5), /* Status Ketua Stasi */
            th:nth-child(6), /* Status Bendahara Paroki */
            th:nth-child(7) { /* Status Romo Paroki */
                display: none !important;
            }

            /* Sembunyikan kolom Status di TBODY (data tabel) */
            td:nth-child(5), /* Data Status Ketua Stasi */
            td:nth-child(6), /* Data Status Bendahara Paroki */
            td:nth-child(7) { /* Data Status Romo Paroki */
                display: none !important;
            }

            /* Sembunyikan badge status (jika masih terlihat) */
            .status-badge {
                display: none !important;
            }

            /* Pastikan border kanan dari kolom 'Jumlah Kolekte' di thead tetap ada */
            th:nth-child(4) {
                border-right: 1px solid #000 !important;
            }
            /* Pastikan border kanan dari kolom 'Jumlah Kolekte' di tbody tetap ada */
            td:nth-child(4) {
                border-right: 1px solid #000 !important;
            }

            /* ========================================================= */


            .bg-white.p-6.rounded-xl.shadow-lg.mb-6 {
                box-shadow: none !important;
                padding: 0 !important;
                background-color: transparent !important;
                border: none !important;
            }
            .overflow-x-auto.rounded-lg.border.border-gray-200.shadow-sm {
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            /* --- END Plain Table Print Styles --- */
        }

        /* CSS Kustom untuk efek hover yang halus (hanya untuk tampilan layar) */
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
            background-color:rgb(60, 128, 237);
            color: white;
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
            color:rgb(30, 71, 124);
        }
        .sidebar-item:not(.active):hover {
            background-color: #e0e7ff;
            color: rgb(30, 71, 124);
        }
        .sidebar-item svg {
            margin-right: 0.75rem;
            color: currentColor;
        }
        .sidebar-brand {
            color: rgb(0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
        .sidebar-brand img {
            height: 2.5rem;
            width: 2.5rem;
            margin-right: 0.75rem;
            border-radius: 9999px;
        }

        .sidebar-container {
            background-color: white;
            color: #334155;
        }

        /* Mobile-specific styles for the hamburger menu and header */
        @media (max-width: 767px) {
           .sidebar-container {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 200px; /* DIKECILKAN: Lebar sidebar di mode HP */
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 21; /* Ensure sidebar is above header */
                box-shadow: 2px 0 5px rgba(0,0,0,0.2); /* Tambahkan shadow untuk visual */
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
                z-index: 20; /* Below sidebar, above content */
                display: none;
            }
            .overlay.active {
                display: block;
            }
            /* Adjusted padding for the body to ensure header content is visible */
            body {
                padding-top: 5rem; /* Increased from 4rem for more space */
            }
             header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.4rem 0.8rem; /* DIKECILKAN: Adjusted header padding for mobile to be smaller */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 1rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 1rem; /* DIKECILKAN: Further reduced font size for mobile header */
                font-weight: bold;
                color: #374151; /* Match general text color */
            }
            header h1 svg {
                display: none; /* HIDE SVG ICON ON MOBILE */
            }
            /* Show welcome message on mobile but with smaller text */
            header .mobile-welcome {
                display: none; /* Show on mobile */
                font-size: 0.875rem; /* text-sm */
                text-align: right;
            }
            header .desktop-welcome {
                display: none; /* Hide desktop welcome on mobile */
            }
            #burger-btn {
                z-index: 22; /* Ensure burger button is clickable above sidebar */
            }
            /* Ensure the main content doesn't have an additional top padding on mobile */
            .main-content {
                padding-top: 0;
                padding-left: 0.75rem; /* DIKECILKAN: Tambahkan sedikit padding kiri dan kanan */
                padding-right: 0.75rem; /* DIKECILKAN: Tambahkan sedikit padding kiri dan kanan */
             
            }
             /* Ukuran font untuk sidebar items di HP */
            .sidebar-item {
                font-size: 0.85rem; /* DIKECILKAN: Ukuran font item sidebar */
                padding: 0.6rem 1rem; /* DIKECILKAN: Padding item sidebar */
            }

            /* Ukuran logo dan teks SIKOPAR di HP */
            .sidebar-brand img {
                height: 2rem; /* DIKECILKAN: Ukuran tinggi logo */
                width: 2rem; /* DIKECILKAN: Ukuran lebar logo */
                margin-right: 0.5rem; /* DIKECILKAN: Jarak antara logo dan teks */
            }
            .sidebar-brand {
                font-size: 1.5rem; /* DIKECILKAN: Ukuran font SIKOPAR */
                padding-top: 0.75rem; /* DIKECILKAN */
                padding-bottom: 0.75rem; /* DIKECILKAN */
            }
            
            
        }

        /* Desktop specific styles - reset mobile overrides */
        @media (min-width: 768px) {
            body {
                padding-top: 0 !important; /* Reset body padding for desktop */
            }
           header {
                position: relative !important;
                /* PENGECILAN HEADER DI DESKTOP (sudah dilakukan sebelumnya) */
                padding: 0.75rem 1.5rem !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important; /* Menambahkan jarak yang lebih besar untuk desktop */
            }
            header h1 {
                /* PENGECILAN FONT HEADER DI DESKTOP (sudah dilakukan sebelumnya) */
                font-size: 1.75rem !important;
            }
            header .mobile-welcome {
                display: none !important; /* Hide mobile welcome on desktop */
            }
            header .desktop-welcome {
                display: none !important; /* Show desktop welcome on desktop */
                align-items: center; /* Vertically align items in desktop welcome */
            }
            header .desktop-welcome span {
                font-size: 0.95rem; /* Slightly smaller welcome text for desktop */
            }
        }

        /* Table Specific Styles (for screen display) */
        .table-header-cell {
            background-color: #e0e7ff;
            color: #3f51b5;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 1rem 1.5rem;
            text-align: left;
        }
        .table-header-cell.text-right {
            text-align: right;
        }
        .table-header-cell.text-center {
            text-align: center;
        }
        .table-data-cell {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.9rem;
            color: #4a5568;
        }
        .table-row:hover {
            background-color: #f7fafc;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.75rem;
            white-space: nowrap;
        }
        .status-divalidasi {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #b45309;
        }
        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .total-row .table-data-cell {
            background-color: #e0e7ff;
            font-weight: bold;
            color: #3f51b5;
        }

        /* Hide print-specific elements on screen */
        .print-header, .print-footer {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Romo Paroki --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative no-print">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.romo-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.romo-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('romo-paroki.laporan.index') }}" class="sidebar-item {{ Request::routeIs('romo-paroki.laporan.index') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Validasi Laporan Kolekte
            </a>
            <a href="{{ route('romo-paroki.laporan.final') }}" class="sidebar-item {{ Request::routeIs('romo-paroki.laporan.final') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Laporan Kolekte Final
            </a>
            {{-- PERBAIKAN: Ganti nama rute menjadi nama rute lengkap yang didefinisikan di web.php --}}
            <a href="{{ route('romo-paroki.laporan.history.romo-paroki') }}" class="sidebar-item {{ Request::routeIs('romo-paroki.laporan.history.romo-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> {{-- Ikon untuk Riwayat --}}
                Riwayat Laporan Final
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

    {{-- Main Content --}}
    <div class="flex-grow p-6 md:p-10 main-content">
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8 no-print">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Laporan Kolekte Final</h1>
            </div>
            <div class="desktop-welcome flex items-center space-x-4">
                <span class="text-gray-700 text-lg">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
            </div>
            <div class="mobile-welcome md:hidden">
                <span class="text-gray-700 text-sm">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
            </div>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 no-print" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 no-print" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Print-specific Header (Visible only on print) --}}
        <div class="print-header">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            <div class="header-content "> {{-- Tambahkan div baru untuk membungkus teks --}}
                <h1>PAROKI SANTO YOSEPH SIDAREJA</h1>
                <h1>KEUSKUPAN PURWOKERTO</h1>
                <p>Jl. Ranggasena No. 596 Tlp. (0280) 523596</p>
                <p>Email:paroki.sanyossidareja@gmail.com</p>
                <p>Sidareja - Cilacap 53261 </p>
            </div>
            {{-- <hr> --}} {{-- HR dipindahkan ke CSS .print-header border-bottom --}}
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg mb-6 card-hover-effect">
            <h3 class="text-['0.9rem'] font-semibold text-gray-800 mb-6 no-print">Daftar Laporan Kolekte yang Sudah Divalidasi Final</h3>

            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg inline-flex items-center no-print mb-6 transition duration-150 ease-in-out shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan Ini
            </button>

            @if ($laporanKolektes->isEmpty())
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Tidak ada data</p>
                    <p>Belum ada laporan kolekte yang divalidasi secara final.</p>
                </div>
            @else
                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="table-header-cell rounded-tl-lg">Tanggal Kolekte</th>
                                <th class="table-header-cell">Stasi</th>
                                <th class="table-header-cell">Nama Pengirim</th>
                                <th class="table-header-cell text-right">Jumlah Kolekte</th>
                                {{-- Kolom Status ini hanya terlihat di layar, disembunyikan untuk cetak oleh CSS di atas --}}
                                <th class="table-header-cell text-center">Status Ketua Stasi</th>
                                <th class="table-header-cell text-center">Status Bendahara Paroki</th>
                                <th class="table-header-cell text-center rounded-tr-lg">Status Romo Paroki</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($laporanKolektes as $laporan)
                                <tr class="table-row">
                                    <td class="table-data-cell whitespace-nowrap">{{ \Carbon\Carbon::parse($laporan->tanggal_kolekte)->format('d M Y') }}</td>
                                    <td class="table-data-cell">{{ $laporan->stasi->nama ?? 'N/A' }}</td>
                                    <td class="table-data-cell">{{ $laporan->nama_pengirim }}</td>
                                    <td class="table-data-cell text-right font-medium">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                    {{-- Kolom status ini hanya terlihat di layar, disembunyikan untuk cetak oleh CSS di atas --}}
                                    <td class="table-data-cell text-center">
                                        <span class="status-badge
                                            @if($laporan->status_ketua_stasi === 'divalidasi') status-divalidasi
                                            @elseif($laporan->status_ketua_stasi === 'ditolak') status-ditolak
                                            @else status-pending @endif">
                                            {{ ucfirst($laporan->status_ketua_stasi) }}
                                        </span>
                                    </td>
                                    <td class="table-data-cell text-center">
                                        <span class="status-badge
                                            @if($laporan->status_bendahara_paroki === 'divalidasi') status-divalidasi
                                            @elseif($laporan->status_bendahara_paroki === 'ditolak') status-ditolak
                                            @else status-pending @endif">
                                            {{ ucfirst($laporan->status_bendahara_paroki) }}
                                        </span>
                                    </td>
                                    <td class="table-data-cell text-center">
                                        <span class="status-badge
                                            @if($laporan->status_romo_paroki === 'divalidasi') status-divalidasi
                                            @elseif($laporan->status_romo_paroki === 'ditolak') status-ditolak
                                            @else status-pending @endif">
                                            {{ ucfirst($laporan->status_romo_paroki) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3" class="table-data-cell text-right font-bold">Total Keseluruhan Kolekte:</td>
                                <td class="table-data-cell font-bold">Rp {{ number_format($totalKolekte, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>

        {{-- Print-specific Footer/Signature Block (Visible only on print) --}}
        <div class="print-date">
            Purwokerto, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>

        {{-- Teks "Mengetahui" --}}
        <div class="knowing-text">
            Mengetahui,
        </div>

        <div class="print-footer">
            {{-- Blok untuk Romo Paroki --}}
            <div class="signer-block">
                <p class="signer-title">Romo Paroki</p>
                {{-- Ruang untuk tanda tangan digital Romo Paroki --}}
                <div class="signature-space">Tanda Tangan Digital</div>
                <p class="signer-name">RD. Andreas Surya Purnawan Br</p> {{-- Ganti dengan nama Romo Paroki yang sebenarnya --}}
            </div>
            {{-- Blok untuk Bendahara Paroki --}}
            <div class="signer-block">
                <p class="signer-title">Bendahara Paroki</p>
                {{-- Ruang untuk tanda tangan digital Bendahara Paroki --}}
                <div class="signature-space">Tanda Tangan Digital</div>
                <p class="signer-name">Fransiska Linawati</p> {{-- Ganti dengan nama Bendahara Paroki yang sebenarnya --}}
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
    </script>
</body>
</html>