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
            background-color:rgb(60, 128, 237); /* A slightly brighter blue for active */
            color: white !important; /* Ensure text is white for active item, use !important if Tailwind overrides */
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
            border-bottom: 1px solid #e2e8f0; /* Warna abu-abu yang lebih terang (setara dengan border-gray-200) */
            padding-bottom: 1rem; /* Ruang di bawah logo/teks sebelum border (pb-4) */
            margin-bottom: 1rem; /* Ruang di bawah border sebelum item navigasi (mb-4) */
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Added shadow for white sidebar */
        }

        /* PERBAIKAN DAN PENAMBAHAN UNTUK TABEL RESPONSIVE DAN MODERN */
        .table-wrapper { /* Kontainer untuk overflow-x, ganti nama dari table-container sebelumnya */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            border-radius: 0.75rem; /* rounded-xl */
            overflow: hidden; /* Memastikan sudut membulat memotong konten */
            /* Default non-scrollable for larger screens, handle overflow via media query */
        }

        .modern-table { /* Kelas untuk styling dasar tabel */
            width: 100%; /* Pastikan tabel mengisi lebar wrapper-nya */
            border-collapse: collapse; /* Menghilangkan spasi antar sel */
        }

        .modern-table thead th {
            background-color: rgb(37, 99, 235); /* blue-600 */
            color: white;
            font-weight: 600; /* semibold */
            text-transform: uppercase;
            font-size: 0.875rem; /* text-sm */
            padding: 1rem 1.5rem; /* py-4 px-6 */
            text-align: left; /* Default to left alignment for headers */
        }
        .modern-table tbody td {
            padding: 1rem 1.5rem; /* py-4 px-6 */
            border-bottom: 1px solid #e5e7eb; /* border-gray-200 */
            font-size: 0.9375rem; /* text-base-ish */
            color: #4b5563; /* gray-700 */
        }
        .modern-table tbody tr:last-child td {
            border-bottom: none; /* No border for the last row */
        }
        .modern-table tbody tr:hover {
            background-color: #eff6ff; /* blue-50 */
        }
        /* Status badge styling */
        .status-badge {
            padding: 0.25rem 0.75rem; /* px-3 py-1 */
            border-radius: 9999px; /* rounded-full */
            font-weight: 600; /* font-semibold */
            font-size: 0.75rem; /* text-xs */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .status-yellow {
            background-color: #fef3c7; /* yellow-100 */
            color: #b45309; /* yellow-800 */
        }
        .status-green {
            background-color: #d1fae5; /* green-100 */
            color: #065f46; /* green-800 */
        }
        .status-red {
            background-color: #fee2e2; /* red-100 */
            color: #991b1b; /* red-800 */
        }
        /* Status for Bendahara Paroki / Romo Paroki - Pending */
        .status-blue {
            background-color: #e0f2fe; /* blue-100 */
            color: #0c4a6e; /* blue-900 */
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
            /* Adjust padding for the card and table container on mobile */
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 1rem !important; /* Less padding for card on mobile */
            }
            /* Make table horizontally scrollable on small screens */
            .table-wrapper {
                overflow-x: auto; /* Enable horizontal scroll */
                -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            }
            .modern-table {
                min-width: 750px; /* Increased min-width to accommodate new columns */
            }
            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.5rem 0.75rem; /* Smaller padding for table cells on mobile */
                font-size: 0.55rem; /* Smaller font size for table text on mobile (text-xs) */

            }
            .modern-table thead th.text-right{
                text-align: center;
            }
            .modern-table thead th.text-center{
                text-align: center;
            }

            .status-badge {
                padding: 0.15rem 0.5rem; /* Smaller padding for badges on mobile */
                font-size: 0.65rem; /* Even smaller font size for badges on mobile */
            }
            /* Adjust action button size on mobile */
            .py-2.px-4.rounded-lg.transition.duration-300.shadow-md.text-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.7rem;
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
                display: flex !important; /* Show desktop welcome on desktop */
                align-items: center; /* Vertically align items in desktop welcome */
            }
            header .desktop-welcome span {
                font-size: 0.95rem; /* Slightly smaller welcome text for desktop */
            }
            /* Reset padding for the card and table container on desktop */
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 2rem !important; /* Normal padding for card on desktop */
            }
            .modern-table {
                min-width: unset; /* Reset min-width on desktop */
            }
            .modern-table thead th {
                padding: 1rem 1.5rem; /* Reset padding */
                font-size: 0.875rem; /* Reset font size */
                text-align: left; /* Default alignment */
            }

            /* Reset khusus untuk header "Aksi" di desktop */
            .modern-table thead th.text-right {
                text-align: right; /* Kembali ke rata kanan default di desktop */
                padding-right: 1.5rem; /* Reset padding */
                padding-left: 1.5rem;  /* Reset padding */
            }
            .modern-table thead th.text-center {
                text-align: center; /* Kembali ke rata tengah default di desktop */
                padding-right: 1.5rem; /* Reset padding */
                padding-left: 1.5rem;  /* Reset padding */
            }


            /* Reset perataan dan padding untuk semua sel data (TD) */
            .modern-table tbody td {
                padding: 1rem 1.5rem; /* Reset padding */
                font-size: 0.9375rem; /* Reset font size */
                text-align: left; /* Default alignment */
            }

            /* Reset khusus untuk sel "Aksi" (TD yang berisi tombol-tombol) */
            .py-3.px-6.text-center.flex.items-center.justify-center.space-x-3 {
                justify-content: center; /* Kembali ke rata tengah di desktop */
                padding-right: 1.5rem; /* Reset padding */
                padding-left: 1.5rem;  /* Reset padding */
            }

            /* Reset ukuran tombol aksi di desktop */
            .py-2.px-4.rounded-lg.transition.duration-300.shadow-md.text-sm {
                padding: 0.5rem 1rem;
                margin-right: 0; /* Reset margin kanan */
                font-size: 0.875rem;
            }

            .status-badge {
                padding: 0.25rem 0.75rem; /* Reset padding badge */
                font-size: 0.75rem; /* Reset font size badge */
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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 0 01-3-3V7a3 0 013-3h4a3 0 013 3v1"></path></svg>
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
                                        <form action="{{ route('ketua-stasi.laporan.validate', $laporan->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md text-sm">
                                                Validasi
                                            </button>
                                        </form>
                                        <button type="button" onclick="showRejectModal({{ $laporan->id }})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md text-sm">
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
        <div class="bg-white p-8 rounded-xl shadow-md mt-8 card-hover-effect"> {{-- mt-8 untuk jarak lebih --}}
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
                                <th class="py-3 px-6 text-left">Catatan Revisi Bendahara</th> {{-- Label Catatan Revisi Bendahara --}}
                                <th class="py-3 px-6 text-center">Status Romo Paroki</th> {{-- Kolom baru --}}
                                <th class="py-3 px-6 text-left">Catatan Revisi Romo</th> {{-- Kolom baru --}}
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
                                    {{-- INI ADALAH BAGIAN UTAMA YANG DIUBAH --}}
                                    <td class="py-3 px-6 text-left">
                                        {{ $laporan->catatan_revisi_bendahara_paroki ?? '-' }}
                                    </td>
                                    {{-- Kolom baru untuk Status Romo Paroki --}}
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
                                    {{-- INI ADALAH BAGIAN UTAMA YANG DIUBAH --}}
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

    {{-- Modal penolakan (tidak diubah, ini hanya untuk validasi ketua stasi) --}}
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

        function showRejectModal(laporanId) {
            const form = document.getElementById('rejectForm');
            // Pastikan URL rute tetap sama, tidak diubah
            form.action = `/ketua-stasi/laporan/${laporanId}/tolak`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('catatan_revisi').value = ''; // Bersihkan input
            // Remove validation error messages if any
            const errorElement = document.querySelector('#catatan_revisi + p.text-red-500');
            if (errorElement) {
                errorElement.remove();
            }
            const textarea = document.getElementById('catatan_revisi');
            textarea.classList.remove('border-red-500', 'ring-red-500');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target == modal) {
                hideRejectModal();
            }
        }
    </script>
</body>
</html>