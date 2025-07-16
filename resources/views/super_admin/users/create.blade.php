<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru - Super Admin</title>
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
                width: 200px; /* DIKECILKAN: Lebar sidebar di mobile */
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
                font-size: 0.65rem; /* Kecilkan font untuk "Admin Features" dll. */
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

            /* Main Header (Tambah User Baru) */
            header.main-app-header { /* Menambahkan kelas untuk identifikasi yang lebih baik */
                position: fixed; /* Tetap fixed jika memang ingin fixed header di mobile */
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10;
                background-color: white;
                padding: 0.4rem 0.8rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0;
                /* margin-bottom dihapus dari sini karena ini adalah fixed header */
            }
            header.main-app-header h1 {
                font-size: 0.8rem;
                font-weight: bold;
                color: #374151;
            }

            /* Mobile Welcome Avatar */
            .mobile-welcome {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .mobile-avatar {
                width: 2.0rem;
                height: 2.0rem;
                background-color: #3B82F6;
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.5rem;
                font-weight: bold;
                text-transform: uppercase;
            }
            header.main-app-header .desktop-welcome {
                display: none; /* Hide desktop welcome on mobile */
            }
            #burger-btn {
                z-index: 22;
            }

            /* Adjusted padding for the main content to account for the fixed header */
            .main-content {
                padding-top: 3.5rem; /* Menambahkan padding-top untuk memberi ruang pada fixed header */
                padding-left: 0.75rem;
                padding-right: 0.75rem;
                /* margin-top: 3rem; Dihapus karena padding-top pada main-content atau body sudah cukup */
            }

            /* Adjusted font sizes for mobile view within the content area */
            .main-content h1.text-3xl {
                font-size: 1.5rem;
            }
            .main-content .bg-white.p-6 {
                padding: 1rem;
            }
            .main-content table th, .main-content table td {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }
            .main-content table a, .main-content table button {
                padding: 0.25rem 0.5rem;
                font-size: 0.65rem;
            }

            /* START: Penyesuaian untuk Form Tambah User di Mobile */
            .bg-white.p-8 { /* Form card */
                padding: 1rem; /* Kecilkan padding pada form card */
                margin: 1rem auto; /* Tengahkankan dan beri margin */
                max-width: 95%; /* Batasi lebar agar tidak terlalu besar di mobile */
            }

            .bg-white.p-8 > div:first-child { /* Header internal: "Form Tambah User" dan tombol "Kembali" */
                flex-direction: column; /* Tumpuk judul dan tombol secara vertikal */
                align-items: flex-start; /* Rata kiri */
                padding-bottom: 0.75rem; /* Sedikit lebih kecil dari desktop */
                margin-bottom: 1rem; /* Sedikit lebih kecil dari desktop */
            }

            .bg-white.p-8 > div:first-child h2 { /* Judul "Form Tambah User" */
                font-size: 1.25rem !important; /* Kecilkan ukuran font */
                margin-bottom: 0.5rem; /* Tambahkan sedikit jarak bawah */
            }

            .bg-white.p-8 > div:first-child a { /* Tombol "Kembali ke Daftar User" */
                padding: 0.4rem 0.75rem !important; /* Kecilkan padding tombol */
                font-size: 0.75rem !important; /* Kecilkan font tombol */
                width: 100%; /* Buat tombol lebar penuh */
                text-align: center; /* Tengahkankan teks tombol */
            }

            .main-content form label {
                font-size: 0.85rem; /* Kecilkan ukuran font label */
                margin-bottom: 0.25rem; /* Kurangi margin bawah label */
            }

            .main-content form input, .main-content form select {
                padding: 0.5rem 0.75rem; /* Kecilkan padding input dan select */
                font-size: 0.85rem; /* Kecilkan ukuran font input dan select */
            }

            .main-content form button[type="submit"] {
                padding: 0.5rem 1rem; /* Kecilkan padding tombol submit */
                font-size: 0.9rem; /* Kecilkan font tombol submit */
                width: 100%; /* Buat tombol submit lebar penuh */
            }

            .main-content .text-gray-600.text-xs.italic {
                font-size: 0.65rem; /* Kecilkan font untuk teks italic di bawah field Stasi */
            }
            /* END: Penyesuaian untuk Form Tambah User di Mobile */
        }

        /* Desktop specific styles - reset mobile overrides and apply new desktop sizes */
        @media (min-width: 768px) {
            body {
                padding-top: 0 !important; /* Reset body padding for desktop */
            }
            header.main-app-header { /* Menggunakan kelas yang lebih spesifik */
                position: relative !important; /* Header tidak fixed di desktop */
                /* PENGECILAN HEADER DI DESKTOP */
                padding: 0.75rem 1.5rem !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important; /* Menambahkan jarak yang lebih besar untuk desktop */
            }
            header.main-app-header h1 {
                /* PENGECILAN FONT HEADER DI DESKTOP */
                font-size: 1.75rem !important; /* Smaller than 4xl but still prominent */
            }
            header.main-app-header .mobile-welcome {
                display: none !important; /* Hide mobile welcome on desktop */
            }
            header.main-app-header .desktop-welcome {
                display: flex !important; /* Show desktop welcome on desktop */
                align-items: center; /* Vertically align items in desktop welcome */
            }
            header.main-app-header .desktop-welcome span {
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
            #burger-btn {
                display: none; /* Hide burger button on desktop */
            }

            /* Adjusted sizes for form elements on desktop */
            .main-content {
                /* Reduced overall padding for desktop main content */
                padding: 1.5rem 2rem; /* Was p-6 md:p-10 -> 2.5rem */
            }
            .main-content h1.text-4xl {
                font-size: 1.75rem; /* Smaller main title for desktop too */
                margin-bottom: 1.5rem; /* Tambahkan margin bawah agar tidak terlalu dekat dengan card */
            }
            .bg-white.p-8 {
                /* Reduced padding for the form card on desktop */
                padding: 1.5rem 2rem; /* Was p-8 -> 2rem */
                max-width: 600px; /* DIKECILKAN: Limit width for better readability on large screens */
                margin-left: auto; /* Center the form */
                margin-right: auto; /* Center the form */
            }
            .main-content form label {
                font-size: 0.95rem; /* Slightly smaller than default 1rem */
            }
            .main-content form input, .main-content form select {
                padding: 0.65rem 0.9rem; /* Slightly smaller than default 0.75rem 1rem */
                font-size: 0.95rem; /* Slightly smaller than default 1rem */
            }
            .main-content form button {
                padding: 0.65rem 1.25rem; /* Slightly smaller button padding */
                font-size: 0.95rem; /* Slightly smaller button font size */
            }
            .main-content .text-xs.italic {
                font-size: 0.75rem;
            }
            .main-content .text-gray-600.text-xs.italic {
                font-size: 0.7rem;
            }

            /* Smaller header title in the form container on desktop */
            .bg-white.p-8 header h2.text-2xl {
                font-size: 1.5rem; /* Original text-2xl */
            }
            .bg-white.p-8 header a.py-2.px-4 {
                padding: 0.5rem 1rem; /* Original padding for "Kembali ke Daftar User" button */
                font-size: 1rem; /* Original font size for the button */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Super Admin (Referenced from your provided modern code) --}}
    <div id="sidebar" class="sidebar-container flex-none w-full md:w-64 pb-4 md:pb-0 shadow-lg z-10 md:relative">
        <div class="p-6 text-center text-2xl font-extrabold sidebar-brand">
            {{-- Sesuaikan path logo jika berbeda --}}
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
            SIKOPAR
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard.super-admin') }}" class="sidebar-item {{ Request::routeIs('dashboard.super-admin') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <div class="mt-4 text-xs uppercase text-gray-400 px-4">Admin Features</div>
            {{-- Link untuk Kelola User - INI ADALAH ITEM AKTIF UNTUK HALAMAN INI --}}
            <a href="{{ route('super-admin.users.index') }}" class="sidebar-item {{ Request::routeIs('super-admin.users.index') || Request::routeIs('super-admin.users.create') || Request::routeIs('super-admin.users.edit') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Kelola User
            </a>

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
    {{-- Tambahkan kelas flex dan flex-col pada main-content untuk memastikan layout vertikal --}}
    <div class="flex-grow p-6 md:p-10 main-content flex flex-col">
        {{-- Menambahkan kelas 'main-app-header' untuk membedakan dari header internal --}}
        <header class="main-app-header bg-white rounded-xl shadow-lg flex items-center justify-between mb-8">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-4xl font-extrabold text-gray-800">Tambah User Baru</h1>
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

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect">
            {{-- Menggunakan div sebagai header internal agar tidak tumpang tindih dengan <header> utama --}}
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 mb-6 flex-wrap gap-2">
                <h2 class="text-2xl font-semibold text-gray-800">Form Tambah User</h2>
                <a href="{{ route('super-admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out shadow-md">
                    Kembali ke Daftar User
                </a>
            </div>

            <form action="{{ route('super-admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                </div>
                <div class="mb-4">
                    <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                    <select id="role_id" name="role_id" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" data-slug="{{ $role->slug }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Container untuk Stasi (akan di-toggle visibility/disabled oleh JS) --}}
                <div class="mb-4" id="stasi_field_container" style="display: none;"> {{-- Added style="display: none;" for initial hiding --}}
                    <label for="stasi_id" class="block text-gray-700 text-sm font-bold mb-2">Stasi (Opsional):</label>
                    <select name="stasi_id" id="stasi_id" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
                        <option value="">-- Pilih Stasi --</option>
                        @foreach ($stasis as $stasi)
                            <option value="{{ $stasi->id }}" {{ old('stasi_id') == $stasi->id ? 'selected' : '' }}>
                                {{ $stasi->nama }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-gray-600 text-xs italic mt-1">Pilih stasi jika user ini terkait dengan Stasi tertentu (misal: Bendahara Stasi, Ketua Stasi).</p>
                    @error('stasi_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out shadow-md">
                        Tambah User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const html = document.documentElement; // Dapatkan elemen html

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            // Ganti document.body.classList.toggle('overflow-hidden')
            // dengan mengontrol overflow pada elemen html untuk menghindari "lompatan" scrollbar
            if (sidebar.classList.contains('active')) {
                html.style.overflowY = 'hidden'; // Sembunyikan scrollbar di html
            } else {
                html.style.overflowY = ''; // Kembalikan default
            }
        }

        // Close sidebar if window is resized above mobile breakpoint
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const html = document.documentElement; // Dapatkan elemen html
            if (window.innerWidth >= 768) { // Tailwind's 'md' breakpoint
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                html.style.overflowY = ''; // Pastikan overflow kembali normal
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role_id');
            const stasiFieldContainer = document.getElementById('stasi_field_container');
            const stasiSelect = document.getElementById('stasi_id');

            function toggleStasiField() {
                const selectedOption = roleSelect.options[roleSelect.selectedIndex];
                // Ensure selectedOption is not null before accessing dataset
                const selectedRoleSlug = selectedOption ? selectedOption.dataset.slug : ''; 

                if (selectedRoleSlug === 'bendahara-stasi' || selectedRoleSlug === 'ketua-stasi') {
                    stasiFieldContainer.style.display = 'block'; // Tampilkan container
                    stasiSelect.removeAttribute('disabled'); // Aktifkan select
                    stasiSelect.setAttribute('required', 'required'); // Make it required
                } else {
                    stasiFieldContainer.style.display = 'none'; // Sembunyikan container
                    stasiSelect.setAttribute('disabled', 'disabled'); // Nonaktifkan select
                    stasiSelect.removeAttribute('required'); // Remove required attribute
                    stasiSelect.value = ""; // Reset selected value when hidden
                }
            }

            // Initial call to set the correct state based on the initial value of role_id (e.g., from old('role_id'))
            toggleStasiField();

            // Add event listener for when the role changes
            roleSelect.addEventListener('change', toggleStasiField);
        });
    </script>
</body>
</html>