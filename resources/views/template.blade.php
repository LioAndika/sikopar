<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Kolekte Final - Bendahara Paroki</title>
    @vite('resources/css/app.css') {{-- Pastikan Vite diatur dengan benar --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Kustom untuk efek hover yang halus */
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
            background-color:rgb(60, 128, 237); /* A slightly brighter blue for active */
            color: white; /* Ensure text is white for active item */
            font-weight: 600;
        }
        /* Ensure non-active sidebar items have visible text */
        .sidebar-item {
            display: flex; /* Use flexbox for icon and text alignment */
            align-items: center; /* Vertically center icon and text */
            padding: 0.75rem 1.5rem; /* py-3 px-6 */
            margin: 0.5rem 0.75rem; /* mx-3 */
            border-radius: 0.5rem; /* rounded-lg */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transitions */
            color:rgb(30, 71, 124); /* Default text color for all sidebar items */
        }
        .sidebar-item:not(.active):hover {
            background-color: #e0e7ff; /* Light blue on hover for non-active items */
            color: rgb(30, 71, 124); /* Ensure text color remains readable on hover */
        }
        .sidebar-item svg {
            margin-right: 0.75rem; /* Space between icon and text */
            color: currentColor; /* Ensures SVG icon color matches text color */
        }
        /* Style for SIKOPAR text and logo to make it black */
        .sidebar-brand {
            color: rgb(0, 0, 0); /* Warna hitam untuk teks SIKOPAR */
            display: flex; /* Menggunakan flexbox untuk logo dan teks */
            align-items: center; /* Memposisikan item secara vertikal di tengah */
            justify-content: center; /* Memposisikan item secara horizontal di tengah */
            background-color: white; /* BACKGROUND PUTIH UNTUK SIKOPAR TEXT */
            /* === Perubahan untuk border abu-abu === */
            border-bottom: 1px solid #e2e8f0; /* Warna abu-abu yang lebih terang (setara dengan border-gray-200) */
            padding-bottom: 1rem; /* Ruang di bawah logo/teks sebelum border (pb-4) */
            margin-bottom: 1rem; /* Ruang di bawah border sebelum item navigasi (mb-4) */
            /* ===================================== */
        }
        .sidebar-brand img {
            height: 2.5rem; /* Ukuran tinggi logo */
            width: 2.5rem; /* Ukuran lebar logo (buat sama untuk proporsional) */
            margin-right: 0.75rem; /* Jarak antara logo dan teks */
            border-radius: 9999px; /* Membuat lingkaran jika gambar square */
        }

        /* PERUBAHAN UTAMA UNTUK SIDEBAR BACKGROUND */
        .sidebar-container { /* Kelas baru untuk sidebar */
            background-color: white; /* Background putih untuk sidebar utama */
            color: #334155; /* Default text color, sesuaikan jika perlu */
        }

        /* Mobile-specific styles for the hamburger menu and header */
      @media (max-width: 767px) { /* Tailwind's 'md' breakpoint is 768px, so less than that is mobile */
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
                padding-top: 3rem; /* DIKECILKAN: Sesuaikan padding-top untuk memberi ruang pada header yang lebih kecil */
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.5rem 0.75rem; /* DIKECILKAN: Adjusted header padding for mobile to be smaller */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 0.75rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 1rem; /* DIKECILKAN: Further reduced font size for mobile header */
                font-weight: bold;
                color: #374151; /* Match general text color */
            }
              /* Mobile Welcome Avatar */
            .mobile-welcome {
                display: flex; /* Show on mobile, use flex for centering */
                align-items: center;
                justify-content: center;
            }
            .mobile-avatar {
                width: 1.8rem; /* DIKECILKAN: Size of the circular avatar */
                height: 1.8rem; /* DIKECILKAN: Size of the circular avatar */
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.6rem; /* DIKECILKAN: Font size for initials */
                font-weight: bold;
                text-transform: uppercase; /* Ensure initials are uppercase */
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
                margin-top:1.5rem;
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
        
        
            /* PERBAIKAN: Adjust filter form layout for mobile */
            .filter-form-grid {
                grid-template-columns: 1fr; /* Stack columns on mobile */
                gap: 0.5rem; /* Smaller gap for mobile */
            }
            /* PERBAIKAN: Tombol Filter */
            .filter-buttons {
                flex-direction: column; /* Stack buttons vertically */
                gap: 0.5rem; /* Space between stacked buttons */
                align-items: stretch; /* Make buttons full width */
            }
            .filter-buttons button,
            .filter-buttons a {
                width: 100%; /* Full width buttons */
                text-align: center; /* Center text in buttons */
                padding: 0.5rem 1rem; /* Mengubah px-6 py-2 menjadi px-4 py-2 (setara dengan padding: 0.5rem 1rem) */
            }

            /* PERBAIKAN: Ukuran Input Filter */
            .filter-form-grid input[type="text"],
            .filter-form-grid input[type="date"],
            .filter-form-grid select {
                font-size: 0.875rem; /* text-sm */
                padding-top: 0.375rem; /* py-1.5 */
                padding-bottom: 0.375rem; /* py-1.5 */
                padding-left: 0.5rem; /* px-2 */
                padding-right: 0.5rem; /* px-2 */
            }

            /* PERBAIKAN: Table specific adjustments for mobile */
            .responsive-table {
                font-size: 0.75rem; /* Smaller font for table on mobile */
            }
            .responsive-table th,
            .responsive-table td {
                padding: 0.5rem 0.75rem; /* Smaller padding for table cells */
            }
            /* PERBAIKAN: max-w-[150px] truncate ditambahkan ke <td> Keterangan */
            .responsive-table .truncate-keterangan {
                max-width: 150px; /* max-w-[150px] */
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            /* PERBAIKAN: Mengurangi padding pada .main-content di mobile */
            .main-content {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            /* Mengubah p-4 md:p-8 menjadi p-4 saja di mobile */
            .bg-white.p-8.rounded-xl.shadow-lg.mb-8.card-hover-effect {
                padding: 1rem !important; /* p-4 equivalent */
            }


            /* PERBAIKAN: Pagination */
            .pagination-container { /* Menambahkan kelas untuk pagination */
                font-size: 0.875rem; /* text-sm */
            }
        }


        /* Desktop specific styles - reset mobile overrides */
        @media (min-width: 768px) {
            body {
                padding-top: 0 !important; /* Reset body padding for desktop */
            }
            header {
                position: relative !important;
                padding: 1rem 1.5rem !important; /* Adjusted padding: py-4 px-6 (from 1.5rem all around) */
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important; /* Mengembalikan margin-bottom header untuk desktop */
            }
            header h1 {
                font-size: 1.75rem !important; /* Smaller font size: text-3xl (from 2.5rem) */
            }
            header .mobile-welcome {
                display: none !important; /* Hide mobile welcome on desktop */
            }
            header .desktop-welcome {
                display: flex !important; /* Show desktop welcome on desktop */
            }
        
            /* PERBAIKAN ULANG UNTUK DESKTOP: Filter Form (Desktop) */
            .filter-form-grid {
                display: grid; /* Gunakan display grid */
                /* Sesuaikan ini jika Anda ingin filter input ada 4 kolom */
                grid-template-columns: repeat(4, 1fr); /* 4 kolom sama lebar */
                gap: 1rem; /* Jarak antar kolom */
                align-items: end; /* Pastikan semua item teratas rata */
            }
            /* PERBAIKAN ULANG UNTUK DESKTOP: Tombol Filter */
            .filter-buttons {
                grid-column: 3 / span 2; /* Menempatkan tombol di kolom ke-3 dan membentang 2 kolom */
                display: flex; /* Gunakan display flex untuk tombol */
                flex-direction: row; /* Tombol berdampingan */
                gap: 0.5rem; /* Jarak antar tombol */
                justify-content: flex-end; /* Posisikan tombol di kanan */
                align-items: center;
            }
            .filter-buttons button,
            .filter-buttons a {
                width: auto; /* Auto width for buttons */
                text-align: center; /* Center text in buttons */
                padding-left: 1.5rem; /* px-6 */
                padding-right: 1.5rem; /* px-6 */
                padding-top: 0.5rem; /* py-2 */
                padding-bottom: 0.5rem; /* py-2 */
            }
            /* Ukuran Input Filter (Desktop) */
            .filter-form-grid input[type="text"],
            .filter-form-grid input[type="date"],
            .filter-form-grid select {
                font-size: 0.875rem; /* sm:text-sm */
                padding-top: 0.375rem; /* py-1.5 */
                padding-bottom: 0.375rem; /* py-1.5 */
                padding-left: 0.75rem; /* px-3 */
                padding-right: 0.75rem; /* px-3 */
            }

            /* Table (Desktop) */
            .responsive-table {
                font-size: 0.875rem; /* Default font size for desktop table */
            }
            .responsive-table th,
            .responsive-table td {
                padding: 0.75rem 1.5rem; /* Default padding for desktop table cells */
            }
            .responsive-table .truncate-keterangan {
                max-width: none; /* Reset max-width for desktop */
                overflow: visible;
                text-overflow: clip;
                white-space: normal;
            }

            /* Main Content Padding (Desktop) */
            .main-content {
                padding-left: 2.5rem; /* p-10 (as in md:p-10) */
                padding-right: 2.5rem; /* p-10 (as in md:p-10) */
            }
            /* Mengubah p-4 md:p-8 */
            .bg-white.p-8.rounded-xl.shadow-lg.mb-8.card-hover-effect {
                padding: 2rem !important; /* md:p-8 equivalent */
            }

            /* Pagination (Desktop) */
            .pagination-container {
                font-size: 1rem; /* Default font size for desktop pagination */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Romo Paroki --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
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
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-4xl font-extrabold text-gray-800">Riwayat Laporan Kolekte Final</h1>
            </div>
            
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Konten Utama Riwayat Laporan --}}
        <div class="bg-white p-8 rounded-xl shadow-lg mb-8 card-hover-effect">
            <h3 class="text-2xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM6.5 9.5a1 1 0 10-2 0 1 1 0 002 0zm4 0a1 1 0 10-2 0 1 1 0 002 0zm4 0a1 1 0 10-2 0 1 1 0 002 0z" clip-rule="evenodd"></path></svg>
                Riwayat Data Kolekte
            </h3>

            {{-- Form Filter dan Pencarian --}}
            {{-- UBAH NAMA RUTE DI SINI --}}
            <form action="{{ route('romo-paroki.laporan.history.romo-paroki') }}" method="GET" class="mb-6 bg-gray-50 p-6 rounded-lg shadow-inner filter-form-grid">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari (Nama Pengirim/Stasi)</label>
                    <input type="text" name="search" id="search" placeholder="Cari laporan..."
                           value="{{ request('search') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date"
                           value="{{ request('start_date') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date"
                           value="{{ request('end_date') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="stasi_id" class="block text-sm font-medium text-gray-700 mb-1">Filter Stasi</label>
                    <select name="stasi_id" id="stasi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Semua Stasi</option>
                        @foreach($stasiOptions as $stasi)
                            <option value="{{ $stasi->id }}" {{ request('stasi_id') == $stasi->id ? 'selected' : '' }}>
                                {{ $stasi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Tambahkan kelas filter-buttons di div ini --}}
                <div class="col-span-full md:col-start-3 md:col-end-5 flex justify-end space-x-2 mt-4 filter-buttons">
                    <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Terapkan Filter
                    </button>
                    {{-- UBAH NAMA RUTE DI SINI --}}
                    <a href="{{ route('romo-paroki.laporan.history.romo-paroki') }}" class="inline-flex items-center px-6 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586l-1.293-1.293z" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-6 responsive-table"> {{-- Tambahkan kelas responsive-table di sini --}}
                <table class="w-full text-sm text-left text-gray-700 responsive-table"> {{-- Tambahkan kelas responsive-table di sini juga --}}
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">Tanggal Kolekte</th>
                            <th scope="col" class="py-3 px-6">Jumlah Kolekte</th>
                            <th scope="col" class="py-3 px-6">Stasi</th>
                            <th scope="col" class="py-3 px-6">Nama Pengirim</th>
                            <th scope="col" class="py-3 px-6">Status Ketua Stasi</th>
                            <th scope="col" class="py-3 px-6">Status Bendahara Paroki</th>
                            <th scope="col" class="py-3 px-6">Status Romo Paroki</th>
                            <th scope="col" class="py-3 px-6">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanKolektes as $laporan)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_kolekte)->format('d M Y') }}
                                </td>
                                <td class="py-4 px-6">Rp {{ number_format($laporan->jumlah_kolekte, 0, ',', '.') }}</td>
                                <td class="py-4 px-6">{{ $laporan->stasi->nama ?? 'N/A' }}</td>
                                <td class="py-4 px-6">{{ $laporan->nama_pengirim }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($laporan->status_ketua_stasi == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_ketua_stasi == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_ketua_stasi)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($laporan->status_bendahara_paroki == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_bendahara_paroki == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_bendahara_paroki)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($laporan->status_romo_paroki == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_romo_paroki == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_romo_paroki)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 truncate-keterangan">{{ $laporan->keterangan ?? '-' }}</td> {{-- Tambahkan kelas truncate-keterangan --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 px-6 text-center text-gray-500">Tidak ada data laporan final yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="text-sm text-gray-700 uppercase bg-gray-50 font-bold">
                        <tr>
                            <td class="py-3 px-6" colspan="2">Total Kolekte Divalidasi</td>
                            <td class="py-3 px-6 text-right" colspan="6">Rp {{ number_format($totalKolekte, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6 pagination-container"> {{-- Tambahkan kelas pagination-container --}}
                {{ $laporanKolektes->appends(request()->query())->links() }}
            </div>
        </div>
        {{-- Akhir Konten Utama Riwayat Laporan --}}

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden'); // Prevent scrolling when sidebar is open
        }

        // Close sidebar if window is resized above mobile breakpoint
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (window.innerWidth >= 768) { // Tailwind's 'md' breakpoint
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
</body>
</html>