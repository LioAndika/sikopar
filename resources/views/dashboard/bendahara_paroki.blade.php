<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bendahara Paroki - SIKOPAR</title>
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
                width: 250px; /* Lebar sidebar di mode HP */
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
                padding-top: 4rem; /* Sesuaikan padding-top untuk memberi ruang pada header */
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.75rem 1rem; /* Adjusted header padding for mobile */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 1rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 1rem; /* Reduced font size for mobile header */
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
                width: 2.2rem; /* Size of the circular avatar */
                height: 2.2rem; /* Size of the circular avatar */
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem; /* Font size for initials */
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
                padding-left: 1rem; /* Tambahkan sedikit padding kiri dan kanan */
                padding-right: 1rem; /* Tambahkan sedikit padding kiri dan kanan */
                margin-top:10px;
            }
            
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 {
                font-size: 1rem; /* Judul papan pengumuman lebih kecil */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 svg {
                width: 1.8rem; /* Ikon lebih kecil */
                height: 1.8rem;
                margin-right: 0.5rem; /* Jarak ikon ke teks lebih kecil */
            }
            .prose p.whitespace-pre-line.leading-relaxed {
                font-size: 0.8rem; /* Konten pengumuman lebih kecil */
            }
            .prose p.text-sm.text-gray-500.mt-3.italic {
                font-size: 0.7rem; /* Info pembuat lebih kecil */
            }
            .prose p.text-gray-500:not([class*="text-sm"]) {
                font-size: 0.8rem; /* Teks "belum ada pengumuman" lebih kecil */
            }

            .grid h3 {
                font-size: 1rem; /* Judul sedikit lebih kecil di mobile */
            }
            .grid p.text-sm.text-gray-600 {
                font-size: 0.8rem; /* Deskripsi lebih kecil di mobile */
            }
            .grid p.text-3xl.font-bold {
                font-size: 1.8rem; /* Angka jumlah lebih kecil di mobile */
            }
            .grid a.mt-4 {
                padding: 0.6rem 1.2rem; /* Tombol lebih kecil di mobile */
                font-size: 0.8rem; /* Teks tombol lebih kecil di mobile */
            }
            /* Ukuran font untuk sidebar items di HP */
            .sidebar-item {
                font-size: 0.9rem; /* Ukuran font item sidebar */
                padding: 0.7rem 1.2rem; /* Padding item sidebar */
            }

            /* Ukuran logo dan teks SIKOPAR di HP */
            .sidebar-brand img {
                height: 2.2rem; /* Ukuran tinggi logo */
                width: 2.2rem; /* Ukuran lebar logo */
                margin-right: 0.6rem; /* Jarak antara logo dan teks */
            }
            .sidebar-brand {
                font-size: 1.6rem; /* Ukuran font SIKOPAR */
                padding-top: 1rem;
                padding-bottom: 1rem;
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
            header .desktop-welcome {
                display: flex !important; /* Show desktop welcome on desktop */
                font-size: 0.9rem; /* DIKECILKAN: Font size teks selamat datang */
            }
            header .desktop-avatar {
                width: 2.2rem; /* DIKECILKAN: Ukuran avatar desktop */
                height: 2.2rem; /* DIKECILKAN: Ukuran avatar desktop */
                font-size: 0.7rem; /* DIKECILKAN: Font size inisial avatar */
            }
            header .mobile-welcome {
                display: none !important; /* Hide mobile welcome on desktop */
            }
        
            /* Styling for desktop avatar - if you want a separate avatar on desktop too */
            .desktop-avatar {
                width: 2.8rem; /* Size of the circular avatar */
                height: 2.8rem;
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem; /* Font size for initials */
                font-weight: bold;
                text-transform: uppercase; /* Ensure initials are uppercase */
                margin-left: 0.85rem; /* Space between text and avatar */
            }
            /* Reset card content sizes for desktop to original or slightly larger */
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 {
                font-size: 1.25rem; /* Original size for desktop announcement title */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 svg {
                width: 1.8rem; /* Original icon size for desktop */
                height: 1.8rem;
                margin-right: 0.5rem; /* Original icon spacing for desktop */
            }
            .prose p.whitespace-pre-line.leading-relaxed {
                font-size: 0.9rem; /* Original content size for desktop */
            }
            .prose p.text-sm.text-gray-500.mt-3.italic {
                font-size: 0.8rem; /* Original info size for desktop */
            }
            .prose p.text-gray-500:not([class*="text-sm"]) {
                font-size: 0.9rem; /* Original "no announcement" size for desktop */
            }
            .grid h3 {
                font-size: 1.25rem; /* Original size for card titles on desktop */
            }
            .grid p.text-sm.text-gray-600 {
                font-size: 0.875rem; /* Original description size for desktop */
            }
            .grid p.text-3xl.font-bold {
                font-size: 2.25rem; /* Original number size for desktop */
            }
            .grid a.mt-4 {
                padding: 0.75rem 1.5rem; /* Original button padding for desktop */
                font-size: 0.875rem; /* Original button text size for desktop */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Bendahara Paroki --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
       <nav class="mt-4">
        <a href="{{ route('dashboard.bendahara-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.bendahara-paroki') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        <a href="{{ route('bendahara-paroki.laporan.index') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.index') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            Validasi Laporan Ketua Stasi
        </a>
        <a href="{{ route('bendahara-paroki.laporan.menunggu-romo') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.menunggu-romo') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v2.47A2.91 2.91 0 006 14h0"></path></svg>
            Laporan Menunggu Romo Paroki
        </a>
        <a href="{{ route('bendahara-paroki.laporan.final') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.final') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Laporan Kolekte Final
        </a>
        {{-- UBAH BARIS INI UNTUK RIWAYAT LAPORAN FINAL --}}
        {{-- BARIS YANG DIPERBAIKI: PERHATIKAN NAMA RUTE LENGKAP --}}
        <a href="{{ route('bendahara-paroki.laporan.history.bendahara-paroki') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.history.bendahara-paroki') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> {{-- Ikon untuk Riwayat --}}
            Riwayat Laporan Final
        </a>
        {{-- LOGOUT BUTTON --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="sidebar-item hover:bg-red-700 hover:text-white mt-4">
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
                    {{-- Jika Super Admin sedang berada di dashboard ini, redirect kembali ke dashboard Super Admin tanpa logout --}}
                    action="{{ route('super-admin.return-to-dashboard') }}"
                @else
                    {{-- Jika ini adalah user Bendahara Stasi asli, logout ke landing page default --}}
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
                <h1 class="text-4xl font-extrabold text-gray-800">Dashboard Bendahara Paroki</h1>
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
            <div class="mobile-avatar">
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

       <div class="bg-white p-8 rounded-xl shadow-lg col-span-full mb-8 mt-3 card-hover-effect">
            <h1 class="text-xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Papan Pengumuman Kolekte
            </h1>
            <div class="prose max-w-none text-gray-700">
                @php
                    if (!isset($announcement)) {
                        try {
                            $announcement = \App\Models\Pengumuman::latest()->first();
                        } catch (\Exception $e) {
                            $announcement = null;
                        }
                    }
                @endphp

                @if ($announcement)
                    <p class="whitespace-pre-line leading-relaxed">{{ $announcement->content }}</p>
                    <p class="text-sm text-gray-500 mt-3 italic">Dibuat oleh: {{ $announcement->user->name ?? 'N/A' }} pada: {{ $announcement->updated_at->format('d M Y H:i') }}</p>                 @else
                    <p class="text-gray-500">Belum ada pengumuman terbaru saat ini.</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Laporan Menunggu Validasi Anda --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center">
                <svg class="w-10 h-10 text-blue-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Menunggu Validasi Anda</h3>
                <p class="text-sm text-gray-600 text-center">Jumlah laporan kolekte dari Ketua Stasi yang menunggu validasi Anda.</p>
                <p class="text-3xl font-bold text-blue-600 mt-4">{{ \App\Models\LaporanKolekte::where('status_ketua_stasi', 'divalidasi')->where('status_bendahara_paroki', 'pending')->count() }}</p>
                <a href="{{ route('bendahara-paroki.laporan.index') }}" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Validasi Sekarang
                </a>
            </div>

            {{-- Laporan Menunggu Romo Paroki --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center">
                <svg class="w-10 h-10 text-yellow-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v2.47A2.91 2.91 0 006 14h0" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Menunggu Romo Paroki</h3>
                <p class="text-sm text-gray-600 text-center">Laporan yang telah Anda validasi dan kini menunggu persetujuan Romo Paroki.</p>
                <p class="text-3xl font-bold text-yellow-600 mt-4">{{ \App\Models\LaporanKolekte::where('status_bendahara_paroki', 'divalidasi')->where('status_romo_paroki', 'pending')->count() }}</p>
                <a href="{{ route('bendahara-paroki.laporan.menunggu-romo') }}" class="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Lihat Laporan
                </a>
            </div>

            {{-- Laporan Kolekte Final --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center">
                <svg class="w-10 h-10 text-green-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Kolekte Final</h3>
                <p class="text-sm text-gray-600 text-center">Total laporan kolekte yang sudah divalidasi dan disetujui sepenuhnya.</p>
                <p class="text-3xl font-bold text-green-600 mt-4">{{ \App\Models\LaporanKolekte::where('status_romo_paroki', 'divalidasi')->count() }}</p>
                <a href="{{ route('bendahara-paroki.laporan.final') }}" class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Lihat Semua
                </a>
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