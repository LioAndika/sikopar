<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bendahara Stasi - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
                margin-top:0.5rem;
            }

            /* Penyesuaian khusus untuk grid kartu dashboard di mode HP */
            .grid {
                grid-template-columns: 1fr; /* Hanya satu kolom di HP */
                gap: 0.75rem; /* DIKECILKAN: Jarak antar kartu */
            }

            .dashboard-card {
                padding: 0.8rem; /* DIKECILKAN: Reduced padding for mobile cards */
                width: 100%; /* Pastikan kartu mengisi lebar penuh */
                box-sizing: border-box; /* Pastikan padding dihitung dalam lebar */
            }

            .dashboard-card h3 {
                font-size: 0.85rem; /* DIKECILKAN: Slightly smaller heading for mobile cards */
                margin-bottom: 0.4rem; /* DIKECILKAN: mb-2 (0.5rem) */
            }

            .dashboard-card p {
                font-size: 0.65rem; /* DIKECILKAN: Even smaller text for description */
            }

            .dashboard-card .text-3xl {
                font-size: 1.3rem; /* DIKECILKAN: Reduced font size for large numbers in mobile cards */
                margin-top: 0.4rem; /* DIKECILKAN: mt-2 (0.5rem) */
            }

            .dashboard-card .mt-4 {
                margin-top: 0.5rem !important; /* DIKECILKAN: Adjust button margin-top */
                padding-top: 0.3rem; /* DIKECILKAN */
                padding-bottom: 0.3rem; /* DIKECILKAN */
                font-size: 0.7rem; /* DIKECILKAN: Smaller font for button */
            }

            /* Reduce announcement section padding on mobile */
            .announcement-card {
                padding: 1rem; /* DIKECILKAN: Reduced padding for announcement card */
            }
            .announcement-card h3 {
                font-size: 1rem; /* DIKECILKAN: Smaller heading for announcement */
            }
            .announcement-card .prose p {
                font-size: 0.75rem; /* DIKECILKAN: Smaller text for announcement content */
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


            /* Desktop: Custom styles for larger cards (default) */
            .dashboard-card {
                padding: 1.25rem; /* Slightly reduced default padding for desktop cards */
                border-radius: 0.75rem;
            }
            .dashboard-card h3 {
                font-size: 1.05rem; /* Slightly reduced heading for desktop cards */
                margin-bottom: 0.6rem;
            }
            .dashboard-card p {
                font-size: 0.8rem; /* Slightly reduced text for description */
            }
            .dashboard-card .text-3xl {
                font-size: 1.75rem; /* Slightly reduced font size for large numbers */
                margin-top: 0.8rem;
            }
            .dashboard-card .mt-4 {
                margin-top: 0.8rem !important;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                font-size: 0.9rem; /* Slightly smaller font for button */
            }
            /* Adjust gap between grid items */
            .grid {
                gap: 1rem; /* Reduced gap from 1.5rem to 1rem */
            }
            /* Adjust padding for the main content area */
            .main-content {
                padding: 2rem; /* Reduced padding from 2.5rem to 2rem */
            }
            /* Adjust header margin-bottom (sudah dipindahkan ke atas) */
            /* header { margin-bottom: 1rem; } */
            /* Reduce announcement section padding */
            .announcement-card {
                padding: 1.75rem; /* Reduced padding from 2rem to 1.75rem */
            }
            .announcement-card h3 {
                font-size: 1.25rem; /* Slightly smaller heading for announcement */
            }
            .announcement-card .prose p {
                font-size: 0.875rem; /* Slightly smaller text for announcement content */
            }

            /* Reset sidebar item and brand font/padding for desktop */
            .sidebar-item {
                font-size: 1rem; /* Default font size for desktop sidebar items */
                padding: 0.75rem 1.5rem; /* Default padding for desktop sidebar items */
            }
            .sidebar-brand img {
                height: 2.5rem; /* Default size for desktop logo */
                width: 2.5rem; /* Default size for desktop logo */
                margin-right: 0.75rem; /* Default margin for desktop logo */
            }
            .sidebar-brand {
                font-size: 2rem; /* Default font size for desktop SIKOPAR text */
                padding-top: 1.5rem; /* Default padding-top for desktop */
                padding-bottom: 1rem; /* Default padding-bottom for desktop */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">

    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.bendahara-stasi') }}" class="sidebar-item {{ Request::routeIs('dashboard.bendahara-stasi') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('laporan.create') }}" class="sidebar-item {{ Request::routeIs('laporan.create') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Tambah Laporan Kolekte
            </a>
            <a href="{{ route('laporan.status.bendahara') }}" class="sidebar-item {{ Request::routeIs('laporan.status.bendahara') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 0 002 2h2a2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Status Validasi Laporan
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

    <div class="flex-grow p-6 md:p-10 main-content">
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-4xl font-extrabold text-gray-800">Dashboard Bendahara Stasi Lingkungan</h1>
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

        <div class="bg-white p-8 rounded-xl shadow-lg col-span-full mb-3 mt-3 card-hover-effect announcement-card">
            <h3 class="text-2xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Papan Pengumuman Kolekte
            </h3>
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
                    <p class="text-sm text-gray-500 mt-3 italic">Dibuat oleh: {{ $announcement->user->name ?? 'N/A' }} pada: {{ \Carbon\Carbon::parse($announcement->updated_at)->format('d M Y H:i') }}</p>
                @else
                    <p class="text-gray-500">Belum ada pengumuman terbaru saat ini.</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center dashboard-card">
                <svg class="w-10 h-10 text-green-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.5a1.5 1.5 0 000-3H5a.5.5 0 01-.5-.5V7.414l.879.879A.5.5 0 006 8.5v1.5a1 1 0 001 1h2a1 1 0 001-1V.414a1 1 0 00-1.707-.707l-.879.879H5a.5.5 0 01-.5-.5V3zm10 0a1 1 0 000 2v8a2 2 0 002 2h2.5a1.5 1.5 0 000-3H15a.5.5 0 01-.5-.5V7.414l.879.879A.5.5 0 0016 8.5v1.5a1 1 0 001 1h2a1 1 0 001-1V.414a1 1 0 00-1.707-.707l-.879.879H15a.5.5 0 01-.5-.5V3z" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Kolekte Terbaru</h3>
                <p class="text-sm text-gray-600 text-center">Lihat detail laporan kolekte terbaru yang telah Anda kirimkan.</p>
                <a href="{{ route('laporan.status.bendahara') }}" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-5 rounded-lg transition duration-300 shadow-md text-sm">
                    Lihat Laporan
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center dashboard-card">
                <svg class="w-10 h-10 text-purple-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 1.83C17.777.94 17.152.023 16.262 0L10 2a3 3 0 01-3-3V1.83A6.002 6.002 0 001.034 16.035L1 18a2 2 0 002 2h14a2 2 0 002-2v-1.965A6.002 6.002 0 0017.555 1.83zM14 16h-4V8h4v8zM14 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Jumlah Kolekte Saya</h3>
                <p class="text-sm text-gray-600 text-center">Total akumulasi kolekte yang berhasil Anda laporkan.</p>
                <p class="text-3xl font-bold text-indigo-700 mt-4">Rp {{ number_format($totalKolekte ?? 0, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col items-center justify-center text-center dashboard-card">
                <svg class="w-10 h-10 text-yellow-500 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Menunggu Validasi</h3>
                <p class="text-sm text-gray-600 text-center">Jumlah laporan kolekte yang masih menunggu validasi.</p>
                <p class="text-3xl font-bold text-yellow-600 mt-4">{{ $pendingLaporanCount ?? 0 }}</p>
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