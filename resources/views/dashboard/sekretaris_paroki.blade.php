<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sekretaris Paroki - SIKOPAR</title>
    @vite('resources/css/app.css')
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

        /* Mobile-specific styles for the hamburger menu and header */
        @media (max-width: 767px) { /* Tailwind's 'md' breakpoint is 768px, so less than that is mobile */
            .sidebar-container {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 220px; /* DIKECILKAN: Lebar sidebar di mode HP */
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
            
            /* Optional: Perkecil font SIKOPAR di mobile sidebar */
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

            /* Adjusted padding for the body to ensure header content is visible */
            body {
                padding-top: 3.5rem; /* Sesuaikan padding-top untuk memberi ruang pada header yang lebih kecil */
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.4rem 0.8rem; /* Adjusted header padding for mobile to be smaller */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 1rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 0.8rem; /* Further reduced font size for mobile header */
                font-weight: bold;
                color: #374151; /* Match general text color */
            }
            /* Mobile Welcome Avatar */
            .mobile-welcome {
                display: flex; /* Show on mobile, use flex for centering */
                align-items: center;
                justify-content: center;
                font-size: 0.75rem; /* Ukuran teks "Selamat datang" di mobile */
            }
            .mobile-welcome span {
                font-size: 0.75rem; /* Ensure the span inside also adjusts */
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
                padding-left: 0.75rem; /* Tambahkan sedikit padding kiri dan kanan */
                padding-right: 0.75rem; /* Tambahkan sedikit padding kiri dan kanan */
            }

            /* --- START: KODE BARU UNTUK UKURAN TEKS KARTU KHUSUS MOBILE --- */

            /* Ukuran teks untuk judul h2 di dalam kartu "Pengumuman Aktif" */
            .bg-white.p-8.rounded-xl.shadow-lg h2 {
                font-size: 1rem; /* Mengurangi ukuran judul di mobile */
            }
            .bg-white.p-8.rounded-xl.shadow-lg h2 svg {
                width: 1rem; /* Sesuaikan ukuran ikon */
                height: 1.5rem;
                margin-right: 0.5rem;
            }

            /* Ukuran teks untuk judul h3 di Pengumuman Aktif */
            .bg-white.p-8.rounded-xl.shadow-lg h3 {
                font-size: 0.8rem; /* Ukuran judul pengumuman */
            }

            /* Ukuran teks untuk paragraf konten di Pengumuman Aktif dan Ringkasan */
            .bg-white.p-8.rounded-xl.shadow-lg p {
                font-size: 0.7rem; /* Lebih kecil untuk konten di mobile */
                line-height: 1.5;
            }

            /* Ukuran teks untuk informasi 'Terakhir diperbarui:' di pengumuman */
            .bg-white.p-8.rounded-xl.shadow-lg .text-sm.text-gray-500 {
                font-size: 0.6rem; /* Lebih kecil lagi untuk informasi tambahan di mobile */
            }

            /* Ukuran teks untuk tombol "Lihat Laporan Kolekte Final" */
            .bg-white.p-8.rounded-xl.shadow-lg a.inline-flex {
                font-size: 0.7rem; /* Ukuran tombol di mobile */
                padding: 0.6rem 1rem; /* Padding tombol di mobile */
            }
            .bg-white.p-8.rounded-xl.shadow-lg a.inline-flex svg {
                width: 1rem;
                height: 1rem;
                margin-right: 0.4rem;
            }

            /* Ukuran teks untuk label form */
            form label {
                font-size: 0.6rem;
            }
            /* Ukuran teks untuk input form */
            form input, form textarea {
                font-size: 0.75rem;
                padding: 0.4rem 0.6rem;
            }
            /* Ukuran teks untuk tombol simpan pengumuman */
            form button[type="submit"] {
                font-size: 0.65rem;
                padding: 0.6rem 1rem;
            }
            form button[type="submit"] svg {
                width: 1rem;
                height: 1rem;
                margin-right: 0.4rem;
            }

            /* Adjust card padding for mobile to be less spacious */
            .bg-white.p-8.rounded-xl {
                padding: 1.5rem; /* Reduced padding for cards on mobile */
            }
            /* --- END: KODE BARU UNTUK UKURAN TEKS KARTU KHUSUS MOBILE --- */
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
                font-size: 0.9rem; /* DIKECILKAN: Font size teks selamat datang */
            }
            /* Styling for desktop avatar */
            .desktop-avatar {
                width: 2.2rem; /* DIKECILKAN: Ukuran avatar desktop */
                height: 2.2rem;
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem; /* DIKECILKAN: Font size for initials */
                font-weight: bold;
                text-transform: uppercase; /* Ensure initials are uppercase */
                margin-left: 0.75rem; /* Space between text and avatar */
            }

            /* Perkecil teks pada card di mode desktop */
            .bg-white.p-8.rounded-xl.shadow-lg h2 {
                font-size: 1.3rem; /* DIKECILKAN: Ukuran judul h2 di card desktop */
            }
            .bg-white.p-8.rounded-xl.shadow-lg h2 svg {
                width: 1.4rem; /* DIKECILKAN: Ukuran ikon di samping judul h2 */
                height: 1.4rem;
                margin-right: 0.5rem;
            }
            .bg-white.p-8.rounded-xl.shadow-lg h3 {
                font-size: 1rem; /* DIKECILKAN: Ukuran judul h3 (pengumuman) */
            }
            .bg-white.p-8.rounded-xl.shadow-lg p {
                font-size: 0.9rem; /* DIKECILKAN: Ukuran paragraf di card desktop */
                line-height: 1.6;
            }
            .bg-white.p-8.rounded-xl.shadow-lg .text-sm.text-gray-500 {
                font-size: 0.8rem; /* DIKECILKAN: Ukuran teks info terakhir diperbarui */
            }
            .bg-white.p-8.rounded-xl.shadow-lg a.inline-flex,
            .bg-white.p-8.rounded-xl.shadow-lg button[type="submit"] {
                font-size: 0.8rem; /* DIKECILKAN: Ukuran tombol di desktop */
                padding: 0.6rem 1.1rem; /* DIKECILKAN: Padding tombol di desktop */
            }
            .bg-white.p-8.rounded-xl.shadow-lg a.inline-flex svg,
            .bg-white.p-8.rounded-xl.shadow-lg button[type="submit"] svg {
                width: 1.1rem; /* DIKECILKAN: Ukuran ikon di tombol */
                height: 1.1rem;
                margin-right: 0.4rem;
            }

            /* Perkecil form element di desktop */
            form label {
                font-size: 0.8rem; /* DIKECILKAN: Label form */
            }
            form input, form textarea {
                font-size: 0.9rem; /* DIKECILKAN: Input dan textarea form */
                padding: 0.5rem 0.8rem; /* DIKECILKAN: Padding input dan textarea */
            }

            /* Adjust card padding for desktop to be less spacious */
            .bg-white.p-8.rounded-xl {
                padding: 2rem; /* DIKECILKAN: Reduced padding for cards on desktop */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Sekretaris Paroki --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.sekretaris-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.sekretaris-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('sekretaris-paroki.laporan.final') }}" class="sidebar-item {{ Request::routeIs('sekretaris-paroki.laporan.final') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan Kolekte Final
            </a>
            <a href="{{ route('sekretaris-paroki.laporan.history.sekretaris-paroki') }}" class="sidebar-item {{ Request::routeIs('romo-paroki.laporan.history.romo-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Riwayat Laporan Final
            </a>
            {{-- LOGOUT BUTTON --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="sidebar-item hover:bg-red-700 mt-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                @if(Auth::user()->hasRole('super-admin'))
                    Kembali ke Dashboard Utama
                @else
                    Logout
                @endif
            </a>
            {{-- LOGOUT FORM DENGAN KONDISIONAL LOGIKA --}}
            <form id="logout-form-sidebar"
                @if(Auth::user()->hasRole('super-admin'))
                    action="{{ route('super-admin.return-to-dashboard') }}"
                @else
                    action="{{ route('logout') }}"
                @endif
                method="POST" class="hidden">
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
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Dashboard Sekretaris Paroki</h1>
            </div>
            <div class="desktop-welcome flex items-center space-x-4">
                <span class="text-gray-700 text-lg">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
                <div class="desktop-avatar">
                    @php
                        $name = Auth::user()->name ?? 'Guest User';
                        $words = explode(' ', $name);
                        $initials = '';
                        if (count($words) == 1 && strlen($words[0]) >= 2) {
                            $initials = strtoupper(substr($words[0], 0, 2));
                        } elseif (count($words) > 1) {
                            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                        } else {
                            $initials = 'GU'; // Default for "Guest User" or empty
                        }
                    @endphp
                    {{ $initials }}
                </div>
            </div>
            <div class="mobile-welcome md:hidden">
                <span class="text-gray-700">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
            </div>
        </header>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Ini adalah div yang mengatur layout grid 2 kolom di desktop --}}
        {{-- ADDED mt-6 CLASS HERE TO CREATE SPACE BETWEEN HEADER AND THE FIRST CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6"> 
            {{-- START: Tambahkan Card Pengumuman Aktif di Sini --}}
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a2 2 0 010 2.828l-3.336 3.336a2 2 0 01-2.828 0l-3.336-3.336a2 2 0 010-2.828l3.336-3.336a2 2 0 012.828 0l3.336 3.336z"></path></svg>
                    Pengumuman Aktif
                </h2>
                @if ($latestAnnouncement)
                    <div class="mb-4">
                        @if ($latestAnnouncement->judul)
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $latestAnnouncement->judul }}</h3>
                        @endif
                        <p class="text-gray-700 mb-2 leading-relaxed">
                            Perolehan Kolekte Misa Tanggal <span class="font-medium">{{ \Carbon\Carbon::parse($latestAnnouncement->tanggal_kolekte)->format('d M Y') }}</span> dengan Jumlah <span class="font-medium">Rp {{ number_format($latestAnnouncement->jumlah_kolekte, 2, ',', '.') }}</span>.
                        </p>
                        <p class="text-gray-500 text-sm">Terakhir diperbarui: {{ \Carbon\Carbon::parse($latestAnnouncement->updated_at)->format('d M Y H:i') }}</p>
                    </div>
                @else
                    <p class="text-gray-600 italic">Belum ada pengumuman kolekte yang aktif.</p>
                @endif
            </div>
            {{-- END: Card Pengumuman Aktif --}}

            {{-- Ringkasan Card (Telah ada) --}}
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ringkasan</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">Selamat datang di Dasbor Sekretaris Paroki. Di sini Anda dapat dengan mudah mengakses dan mengelola laporan kolekte yang sudah divalidasi secara final oleh Romo Paroki. Fungsi utama Anda adalah untuk melihat laporan keuangan yang sudah lengkap.</p>
                <a href="{{ route('sekretaris-paroki.laporan.final') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Lihat Laporan Kolekte Final
                </a>
            </div>

            {{-- Pengumuman Kolekte Card (Form Edit, telah ada) --}}
            <div class="md:col-span-2 bg-white p-8 rounded-xl shadow-lg card-hover-effect">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-7 h-7 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592L7 19H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 011 1v1.882zm9.914 1.356l-6.69 6.69a1 1 0 01-1.414 0l-1.414-1.414a1 1 0 010-1.414l6.69-6.69a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414z"></path></svg>
                    Form Perbarui Pengumuman Kolekte
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed">Gunakan formulir ini untuk membuat atau memperbarui pengumuman kolekte yang akan ditampilkan di dashboard lain. Data yang Anda masukkan di sini akan menjadi pengumuman aktif.</p>

                <form action="{{ route('sekretaris-paroki.pengumuman.update') }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Gunakan metode PUT untuk operasi pembaruan --}}

                    <div class="mb-5">
                        <label for="judul_pengumuman" class="block text-gray-700 text-sm font-bold mb-2">Judul Pengumuman (Opsional):</label>
                        <input type="text" id="judul_pengumuman" name="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" value="{{ old('judul', $latestAnnouncement->judul ?? '') }}" placeholder="Contoh: Pengumuman Kolekte Pekan Ini">
                        @error('judul')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="tanggal_kolekte" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kolekte:</label>
                        <input type="date" id="tanggal_kolekte" name="tanggal_kolekte" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" value="{{ old('tanggal_kolekte', $latestAnnouncement->tanggal_kolekte ?? '') }}" required>
                        @error('tanggal_kolekte')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="jumlah_kolekte" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Kolekte (Rp):</label>
                        <input type="number" id="jumlah_kolekte" name="jumlah_kolekte" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" value="{{ old('jumlah_kolekte', $latestAnnouncement->jumlah_kolekte ?? '') }}" step="0.01" min="0" required>
                        @error('jumlah_kolekte')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Pengumuman
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="text-center text-gray-600 py-4 mt-8">
            <div class="mt-8 text-center text-gray-500 text-sm ">
            &copy; Created by Stefanus Cecilio 2025 Paroki Santo Yoseph Sidareja.
        </div>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden'); // Mencegah scrolling saat sidebar terbuka
        }

        // Tutup sidebar jika ukuran jendela diubah di atas breakpoint mobile
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (window.innerWidth >= 768) { // Breakpoint 'md' Tailwind
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
</body>
</html>