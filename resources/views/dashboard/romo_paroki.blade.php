<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Romo Paroki - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
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
            }
            
            /* Jarak dari chart pertama dengan header di mode mobile */
            .main-content > div:first-of-type { /* Ini menargetkan elemen div pertama di dalam main-content */
                margin-top: 1.5rem; /* Atur jarak sesuai kebutuhan Anda, contoh 4rem */
            }

            /* Perkecil teks pada card karena terlalu besar */
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.card-hover-effect h3 {
                font-size: 1.2rem; /* Judul papan pengumuman lebih kecil */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.card-hover-effect h3 svg {
                width: 1.2rem; /* Ikon lebih kecil */
                height: 1.2rem;
                margin-right: 0.3rem; /* Jarak ikon ke teks lebih kecil */
            }
            .prose h4 {
                font-size: 1rem; /* Judul pengumuman di dalam prose lebih kecil */
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

            .grid h2 {
                font-size: 1.2rem; /* Judul card di grid lebih kecil di mobile */
            }
            .grid h2 svg {
                width: 1.5rem; /* Ukuran ikon di card lebih kecil */
                height: 1.5rem;
                margin-right: 0.4rem;
            }
            .grid p.text-gray-600 {
                font-size: 0.8rem; /* Deskripsi card lebih kecil di mobile */
            }
            .grid a.mt-4, .grid button.mt-4 {
                padding: 0.6rem 1.2rem; /* Padding tombol lebih kecil di mobile */
                font-size: 0.8rem; /* Teks tombol lebih kecil di mobile */
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
            /* Reset margin-top for the first content div on desktop */
            .main-content > div:first-of-type {
                margin-top: 0 !important;
            }
             /* Perkecil teks pada card di mode desktop */
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.card-hover-effect h3 {
                font-size: 1.5rem; /* DIKECILKAN: Judul papan pengumuman desktop */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.card-hover-effect h3 svg {
                width: 1.3rem; /* DIKECILKAN: Ikon judul papan pengumuman desktop */
                height: 1.3rem;
                margin-right: 0.4rem; /* DIKECILKAN: Jarak ikon ke teks */
            }
            .prose h4 {
                font-size: 1.1rem; /* DIKECILKAN: Judul pengumuman di dalam prose desktop */
            }
            .prose p.whitespace-pre-line.leading-relaxed {
                font-size: 0.9rem; /* DIKECILKAN: Konten pengumuman desktop */
            }
            .prose p.text-sm.text-gray-500.mt-3.italic {
                font-size: 0.8rem; /* DIKECILKAN: Info pembuat desktop */
            }
            .prose p.text-gray-500:not([class*="text-sm"]) {
                font-size: 0.9rem; /* DIKECILKAN: Teks "belum ada pengumuman" desktop */
            }

            .grid h2 {
                font-size: 1.3rem; /* DIKECILKAN: Judul card di grid desktop */
            }
            .grid h2 svg {
                width: 1.4rem; /* DIKECILKAN: Ukuran ikon di card desktop */
                height: 1.4rem;
                margin-right: 0.5rem;
            }
            .grid p.text-gray-600 {
                font-size: 0.9rem; /* DIKECILKAN: Deskripsi card desktop */
            }
            .grid a.mt-4, .grid button.mt-4 {
                padding: 0.6rem 1.1rem; /* DIKECILKAN: Padding tombol desktop */
                font-size: 0.8rem; /* DIKECILKAN: Teks tombol desktop */
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
                <h1 class="text-4xl font-extrabold text-gray-800">Dashboard Romo Paroki</h1>
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
            </div>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- START: Papan Pengumuman Kolekte --}}
        <div class="bg-white p-8 rounded-xl shadow-lg col-span-full mb-8 card-hover-effect">
            <h3 class="text-2xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Papan Pengumuman Kolekte
            </h3>
            <div class="prose max-w-none text-gray-700">
                @php
                    // Ambil pengumuman terbaru dengan memuat relasi user
                    $announcement = \App\Models\Pengumuman::latest()->with('user')->first();
                @endphp

                @if ($announcement)
                    {{-- Tampilkan judul jika ada --}}
                    @if ($announcement->judul)
                        <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $announcement->judul }}</h4>
                    @endif
                    <p class="whitespace-pre-line leading-relaxed">{{ $announcement->content }}</p>
                    <p class="text-sm text-gray-500 mt-3 italic">Dibuat oleh: {{ $announcement->user->name ?? 'N/A' }} pada: {{ $announcement->updated_at->format('d M Y H:i') }}</p>
                @else
                    <p class="text-gray-500">Belum ada pengumuman terbaru saat ini.</p>
                @endif
            </div>
        </div>
        {{-- END: Papan Pengumuman Kolekte --}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Card: Ringkasan Laporan Kolekte --}}
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 2v-6m2 2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3l2 4"></path></svg>
                        Ringkasan Laporan Kolekte
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">Lihat laporan kolekte yang menunggu validasi akhir Anda.</p>
                </div>
                <a href="{{ route('romo-paroki.laporan.index') }}" class="mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Lihat & Validasi Laporan
                </a>
            </div>

            {{-- Card: Laporan Kolekte Final --}}
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Laporan Kolekte Final
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">Akses semua laporan kolekte yang telah divalidasi dan diselesaikan.</p>
                </div>
                <a href="{{ route('romo-paroki.laporan.final') }}" class="mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-150 ease-in-out shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Lihat Laporan Final
                </a>
            </div>

            {{-- Card: Statistik Kolekte Bulanan (Placeholder) --}}
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        Statistik Kolekte
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">Analisis tren kolekte dan ringkasan keuangan berdasarkan bulan.</p>
                </div>
                <button class="mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-gray-400 cursor-not-allowed shadow-md" disabled>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5v-5h-.586a1 1 0 01-.707-.293l-4.414-4.414A1 1 0 013 14.586V19a2 2 0 002 2h1zm9-19v5h5"></path></svg>
                    Segera Hadir
                </button>
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