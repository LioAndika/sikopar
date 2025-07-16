<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - SIKOPAR</title>
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

        @media (max-width: 767px) { /* Tailwind's 'md' breakpoint is 768px, so less than that is mobile */
            .sidebar-container {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 200px; /* Lebar sidebar di mobile */
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 21; /* Ensure sidebar is above header */
                overflow-y: auto; /* Izinkan scroll vertikal */
                padding-bottom: 1rem; /* Tambahkan padding bawah agar konten terbawah bisa di-scroll */
            }
            .sidebar-container.active {
                transform: translateX(0);
            }
            .sidebar-container .sidebar-brand {
                padding-top: 1rem; /* Tambahkan padding atas untuk brand di mobile */
                padding-bottom: 0.5rem;
                margin-bottom: 0.5rem;
            }
            .sidebar-container .sidebar-brand img {
                height: 2rem; /* Kecilkan logo di mobile */
                width: 2rem;
            }
            .sidebar-container .sidebar-brand {
                font-size: 1.5rem; /* Kecilkan font SIKOPAR di mobile */
            }
            .sidebar-item {
                padding: 0.5rem 1rem; /* Kecilkan padding sidebar item di mobile */
                margin: 0.3rem 0.5rem; /* Kecilkan margin sidebar item di mobile */
                font-size: 0.9rem; /* Kecilkan font sidebar item di mobile */
            }
            .sidebar-item svg {
                width: 1.25rem; /* Kecilkan ikon di mobile */
                height: 1.25rem;
                margin-right: 0.5rem;
            }
            .sidebar-container .text-xs.uppercase.text-gray-400 {
                font-size: 0.7rem; /* Disesuaikan: Kecilkan font untuk "Admin Features" dll. tapi tidak terlalu kecil */
                padding-left: 1rem;
                padding-right: 1rem;
                margin-top: 0.75rem;
                margin-bottom: 0.25rem;
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
                padding-top: 3.5rem; /* Sesuaikan padding-top untuk memberi ruang pada header yang lebih kecil */
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.5rem 1rem; /* Disesuaikan: Adjusted header padding for mobile to be smaller but not too small */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 1rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 1rem; /* Disesuaikan: Reduced font size for mobile header to be more readable */
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
                width: 2.2rem; /* Disesuaikan: Size of the circular avatar, slightly larger */
                height: 2.2rem; /* Disesuaikan: Size of the circular avatar, slightly larger */
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem; /* Disesuaikan: Font size for initials, more readable */
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
                padding-left: 1rem; /* Disesuaikan: Tambahkan sedikit padding kiri dan kanan */
                padding-right: 1rem; /* Disesuaikan: Tambahkan sedikit padding kiri dan kanan */
                padding-bottom: 1rem; /* Tambahkan padding bawah agar tidak terlalu mepet footer */
            }

            /* --- Penyesuaian Ukuran Teks Konten Utama di Mobile --- */
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect {
                padding: 1.5rem; /* Disesuaikan: Padding card pengumuman lebih proporsional */
                margin-top: 1rem; /* Disesuaikan: Kurangi margin top */
                margin-bottom: 1.5rem; /* Disesuaikan: Kurangi margin bottom */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 {
                font-size: 1rem; /* Disesuaikan: Judul papan pengumuman lebih besar */
                margin-bottom: 0.75rem; /* Disesuaikan: Jarak bawah judul */
                padding-bottom: 0.75rem; /* Disesuaikan: Padding bawah border judul */
            }
            .bg-white.p-8.rounded-xl.shadow-lg.col-span-full.mb-8.mt-3.card-hover-effect h1 svg {
                width: 1.75rem; /* Disesuaikan: Ikon lebih besar */
                height: 1.75rem;
                margin-right: 0.5rem; /* Disesuaikan: Jarak ikon ke teks */
            }
            .prose p.whitespace-pre-line.leading-relaxed {
                font-size: 0.85rem; /* Disesuaikan: Konten pengumuman lebih besar */
                line-height: 1.5; /* Sesuaikan line-height untuk keterbacaan */
            }
            .prose p.text-sm.text-gray-500.mt-3.italic {
                font-size: 0.75rem; /* Disesuaikan: Info pembuat lebih besar */
                margin-top: 1rem; /* Disesuaikan: Jarak atas info pembuat */
            }
            .prose p.text-gray-500:not([class*="text-sm"]) {
                font-size: 0.85rem; /* Disesuaikan: Teks "belum ada pengumuman" lebih besar */
            }

            /* --- Penyesuaian Kartu Total User / Total Stasi di Mobile --- */
            .grid {
                gap: 1rem; /* Disesuaikan: Jarak antar grid item */
            }
            .grid h3 {
                font-size: 1.1rem; /* Disesuaikan: Judul kartu lebih besar */
                margin-bottom: 0.5rem; /* Disesuaikan: Jarak bawah judul */
            }
            .grid p.text-sm.text-gray-600 {
                font-size: 0.75rem; /* Disesuaikan: Deskripsi lebih besar */
                margin-bottom: 0.5rem; /* Disesuaikan: Jarak bawah deskripsi */
            }
            .grid p.text-3xl.font-bold {
                font-size: 2rem; /* Disesuaikan: Angka jumlah lebih besar */
                margin-top: 0.75rem; /* Disesuaikan: Jarak atas angka */
            }
            .grid a.mt-4 {
                padding: 0.6rem 1.2rem; /* Disesuaikan: Tombol lebih besar */
                font-size: 0.85rem; /* Disesuaikan: Teks tombol lebih besar */
                margin-top: 1rem !important; /* Pastikan margin-top tombol tetap berlaku */
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
            /* Styling for desktop avatar - if you want a separate avatar on desktop too */
            .desktop-avatar {
                width: 2.5rem; /* Size of the circular avatar */
                height: 2.5rem;
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.85rem; /* Font size for initials */
                font-weight: bold;
                text-transform: uppercase; /* Ensure initials are uppercase */
                margin-left: 0.75rem; /* Space between text and avatar */
            }
            .grid h3 {
                font-size: 1.25rem; /* Reset to original larger size for desktop */
            }
            .grid p.text-sm.text-gray-600 {
                font-size: 0.875rem; /* Reset to original larger size for desktop */
            }
            .grid p.text-3xl.font-bold {
                font-size: 3rem; /* Reset to original larger size for desktop */
            }
            .grid a.mt-4 {
                padding: 0.5rem 1.25rem; /* Reset to original larger size for desktop */
                font-size: 1rem; /* Reset to original larger size for desktop */
            }
        }

        /* Chart container specific styles */
        .chart-container {
            width: 100%;
            max-width: 900px; /* Adjust as needed */
            margin: 40px auto; /* Centered with top/bottom margin */
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .chart-container h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }

        /* === PERBAIKAN UKURAN GRAFIK: ATUR TINGGI KANVAS SECARA EKSPLISIT === */
        .chart-container canvas {
            height: 450px !important; /* Contoh tinggi, sesuaikan sesuai kebutuhan Anda */
            width: 100% !important; /* Pastikan lebar 100% dari parent */
        }
        /* ================================================================= */

        @media (max-width: 767px) {
            .chart-container {
                padding: 1.5rem; /* Disesuaikan: Padding lebih besar */
                margin-top: 1.5rem; /* Disesuaikan: Margin lebih besar */
                margin-bottom: 1.5rem; /* Disesuaikan: Margin lebih besar */
            }
            .chart-container h2 {
                font-size: 1.1rem; /* Disesuaikan: Judul chart lebih besar */
                margin-bottom: 1rem;
                padding-bottom: 0.75rem; /* Disesuaikan: Padding bawah judul */
            }
            /* Pada mobile, sesuaikan tinggi kanvas jika perlu */
            .chart-container canvas {
                height: 280px !important; /* Disesuaikan: Tinggi lebih besar untuk mobile */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Super Admin --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki"> {{-- Assuming logo.jpg exists in public/images --}}
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.super-admin') }}" class="sidebar-item {{ Request::routeIs('dashboard.super-admin') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <div class="mt-4 text-xs uppercase text-gray-400 px-4">Admin Features</div>
            <a href="{{ route('super-admin.users.index') }}" class="sidebar-item {{ Request::routeIs('super-admin.users.index') || Request::routeIs('super-admin.users.create') || Request::routeIs('super-admin.users.edit') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Kelola User
            </a>

            {{-- Link for Kelola Stasi --}}
            <a href="{{ route('super-admin.stasi.index') }}" class="sidebar-item {{ Request::routeIs('super-admin.stasi.index') || Request::routeIs('super-admin.stasi.create') || Request::routeIs('super-admin.stasi.edit') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Kelola Stasi
            </a>

            <div class="mt-4 text-xs uppercase text-gray-400 px-4">Akses Dashboard Peran Lain</div>
            <a href="{{ route('dashboard.bendahara-stasi') }}" class="sidebar-item {{ Request::routeIs('dashboard.bendahara-stasi') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 4v4m-4 0h8m-8 4H4M7.657 7.657l-1.414-1.414M16.343 7.657l1.414-1.414M7.657 16.343l-1.414 1.414M16.343 16.343l1.414 1.414M21 12h-4M7 12H3"></path></svg>
                Dashboard Bendahara Stasi
            </a>
            <a href="{{ route('dashboard.ketua-stasi') }}" class="sidebar-item {{ Request::routeIs('dashboard.ketua-stasi') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V4a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h2m5-9V3l2 4m-2 2H9m1.5-6H14m-1.5 6H14"></path></svg>
                Dashboard Ketua Stasi
            </a>
            <a href="{{ route('dashboard.bendahara-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.bendahara-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Dashboard Bendahara Paroki
            </a>
            <a href="{{ route('dashboard.sekretaris-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.sekretaris-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4 5-2zm0 0h5.5l-4.5 9.5-2-5-5-2V9.5"></path></svg>
                Dashboard Sekretaris Paroki
            </a>
            <a href="{{ route('dashboard.romo-paroki') }}" class="sidebar-item {{ Request::routeIs('dashboard.romo-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4c0-1.657 1.343-3 3-3s3 1.343 3 3M15 12V6M9 12V6M5 19H3v-1a6 6 0 0112 0v1h-2a2 2 0 00-2 2H7a2 2 0 00-2-2z"></path></svg>
                Dashboard Romo Paroki
            </a>

            {{-- LOGOUT BUTTON --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="sidebar-item hover:bg-red-700 mt-4">
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
                <h1 class="text-4xl font-extrabold text-gray-800">Dashboard Super Admin</h1>
            </div>
            <div class="desktop-welcome flex items-center space-x-4">
                <span class="text-gray-700 text-lg">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name ?? 'Pengguna' }}!</span></span>
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
                    <p class="text-sm text-gray-500 mt-3 italic">Dibuat oleh: {{ $announcement->user->name ?? 'N/A' }} pada: {{ $announcement->updated_at->format('d M Y H:i') }}</p>
                @else
                    <p class="text-gray-500">Belum ada pengumuman terbaru saat ini.</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6"> {{-- Changed to lg:grid-cols-2 to make space for the chart on its own line --}}
            {{-- Total Users --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center">
                <svg class="w-10 h-10 text-blue-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Total User</h3>
                <p class="text-sm text-gray-600 text-center">Jumlah keseluruhan pengguna terdaftar dalam sistem.</p>
                <p class="text-3xl font-bold text-blue-600 mt-4">{{ $totalUsers ?? 0 }}</p>
                <a href="{{ route('super-admin.users.index') }}" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Kelola User
                </a>
            </div>

            {{-- Total Stasi --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center">
                <svg class="w-10 h-10 text-green-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Stasi</h3>
                <p class="text-sm text-gray-600 text-center">Jumlah total stasi yang terdaftar.</p>
                <p class="text-3xl font-bold text-green-600 mt-4">{{ $totalStasi ?? 0 }}</p>
                <a href="{{ route('super-admin.stasi.index') }}" class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Kelola Stasi
                </a>
            </div>
        </div>

        {{-- CHART SECTION - This remains as is, now it will be visible directly --}}
        <div class="chart-container">
            <h2>Grafik Kolekte Bulanan</h2>
            <canvas id="monthlyCollectionChart"></canvas>
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

    {{-- Chart.js Library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Chart Initialization Script --}}
    <script>
        // Data from Laravel Controller will be available here through Blade
        // Make sure these variables ($chartLabels, $chartData) are passed from your SuperAdminController
        const chartLabels = @json($chartLabels);
        const chartData = @json($chartData);

        const ctx = document.getElementById('monthlyCollectionChart').getContext('2d');
        const monthlyCollectionChart = new Chart(ctx, {
            type: 'bar', // Can be 'line', 'bar', 'pie', etc.
            data: {
                labels: chartLabels, // Month/Year labels from controller
                datasets: [{
                    label: 'Total Kolekte Bulanan',
                    data: chartData, // Collection amounts from controller
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', // Example color
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Set to false to allow custom sizing
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Kolekte (Rp)'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                // Format as currency
                                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>