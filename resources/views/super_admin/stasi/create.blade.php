<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stasi Baru - Super Admin</title>
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
        }

        /* --- Perbaikan Mobile --- */
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

            /* Adjusted padding for the body to ensure fixed header content is visible */
            body {
                padding-top: 3.5rem; /* Sesuaikan padding-top untuk memberi ruang pada header yang lebih kecil (sekitar tinggi header) */
            }

            /* KODE UNTUK MENGATASI SCROLL JUMP DENGAN overflow-hidden */
            body.overflow-hidden-active {
                overflow: hidden;
                /* Tambahkan padding-right untuk mengkompensasi hilangnya scrollbar vertikal */
                padding-right: var(--scrollbar-width, 0px); /* Ditetapkan oleh JS */
            }

            header.main-app-header { /* Pastikan ini menargetkan header aplikasi utama */
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 15; /* Ensure header is above main content, but below sidebar/overlay */
                background-color: white; /* Ensure header has a background */
                padding: 0.4rem 0.8rem; /* Adjusted header padding for mobile to be smaller */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
            }
            header.main-app-header h1 {
                font-size: 0.8rem; /* Further reduced font size for mobile header */
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
                width: 2.0rem; /* Size of the circular avatar */
                height: 2.0rem;
                background-color: #3B82F6; /* Blue background */
                color: white; /* White text for initials */
                border-radius: 50%; /* Make it circular */
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.5rem; /* Font size for initials */
                font-weight: bold;
                text-transform: uppercase; /* Ensure initials are uppercase */
            }
            header.main-app-header .desktop-welcome {
                display: none; /* Hide desktop welcome on mobile */
            }
            #burger-btn {
                z-index: 22; /* Ensure burger button is clickable above sidebar */
            }
            /* Ensure the main content doesn't have an additional top padding on mobile */
            .main-content {
                padding-top: 0; /* body sudah menangani padding untuk fixed header */
                margin-top: 0; /* Pastikan tidak ada margin-top yang tumpang tindih */
                margin-top:1.5rem;
            }

            /* Adjusted font sizes for mobile view within the content area */
            .main-content h1.text-4xl { /* Adjusted selector for the main page title */
                font-size: 1.5rem; /* Smaller main title for mobile */
            }

            /* PERUBAHAN FOKUS: Form dan Tombol di Mobile */
            .main-content .bg-white.p-8 { /* Form container */
                padding: 0.8rem; /* **DIKECILKAN**: Lebih kecil lagi untuk form container */
            }
            .main-content .bg-white.p-8 header {
                display: flex;
                flex-direction: column; /* Ubah ke column agar judul dan tombol tidak terlalu mepet */
                align-items: flex-start; /* Sejajarkan ke kiri saat kolom */
                justify-content: flex-start; /* Sejajarkan ke atas saat kolom */
                padding-bottom: 0.8rem; /* Sedikit lebih kecil */
                margin-bottom: 0.8rem; /* Sedikit lebih kecil */
                border-bottom: 1px solid #e2e8f0;
            }
            .main-content .bg-white.p-8 header h2 {
                font-size: 1.1rem; /* **DIKECILKAN**: Judul form lebih kecil */
                margin-bottom: 0.5rem; /* Tambah sedikit ruang di bawah judul */
            }
            .main-content .bg-white.p-8 header a { /* Tombol "Kembali ke Daftar Stasi" */
                padding: 0.3rem 0.6rem; /* **DIKECILKAN**: Tombol lebih kecil */
                font-size: 0.7rem; /* **DIKECILKAN**: Font tombol lebih kecil */
                width: 100%; /* Agar tombol kembali mengambil lebar penuh di mobile */
                text-align: center; /* Pusatkan teks tombol */
            }

            .main-content form label {
                font-size: 0.8rem; /* **DIKECILKAN**: Label lebih kecil */
                margin-bottom: 0.3rem; /* Kurangi margin bawah label */
            }
            .main-content form input,
            .main-content form textarea {
                padding: 0.4rem 0.6rem; /* **DIKECILKAN**: Input/textarea lebih kecil */
                font-size: 0.8rem; /* **DIKECILKAN**: Font input/textarea lebih kecil */
            }
            .main-content form button[type="submit"] { /* Tombol submit */
                padding: 0.4rem 0.8rem; /* **DIKECILKAN**: Tombol submit lebih kecil */
                font-size: 0.8rem; /* **DIKECILKAN**: Font tombol submit lebih kecil */
                width: 100%; /* Agar tombol submit mengambil lebar penuh di mobile */
                text-align: center; /* Pusatkan teks tombol */
            }
            .main-content .mb-4 {
                margin-bottom: 0.8rem; /* Kurangi margin-bottom antar field */
            }
        }

        /* Desktop specific styles - reset mobile overrides */
        @media (min-width: 768px) {
            body {
                padding-top: 0 !important; /* Reset body padding for desktop */
                overflow: auto !important; /* Pastikan overflow normal di desktop */
                padding-right: 0 !important; /* Reset padding-right */
            }
            header.main-app-header { /* Pastikan ini menargetkan header aplikasi utama */
                position: relative !important; /* Kembali ke posisi normal di desktop */
                padding: 0.75rem 1.5rem !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important; /* Menambahkan jarak yang lebih besar untuk desktop */
            }
            header.main-app-header h1 {
                font-size: 1.75rem !important;
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

            /* Resetting form element sizes for desktop */
            .main-content h1.text-4xl {
                font-size: 2.25rem; /* Original size */
            }
            .main-content .bg-white.p-8 {
                padding: 1.5rem; /* **DIKECILKAN**: Mengurangi padding untuk desktop */
            }
            .main-content .bg-white.p-8 header {
                flex-direction: row; /* Kembali ke row di desktop */
                align-items: center; /* Kembali ke tengah di desktop */
                justify-content: space-between; /* Kembali ke space-between di desktop */
                padding-bottom: 0.75rem; /* Sedikit dikurangi */
                margin-bottom: 1rem; /* Sedikit dikurangi */
            }
            .main-content .bg-white.p-8 header h2 {
                font-size: 1.25rem; /* **DIKECILKAN**: Judul form lebih kecil untuk desktop */
                margin-bottom: 0; /* Hapus margin di desktop */
            }
            .main-content .bg-white.p-8 header a {
                padding: 0.4rem 0.8rem; /* **DIKECILKAN**: Tombol lebih kecil untuk desktop */
                font-size: 0.9rem; /* **DIKECILKAN**: Font tombol lebih kecil untuk desktop */
                width: auto; /* Kembali ke auto */
            }
            .main-content form label {
                font-size: 0.9rem; /* **DIKECILKAN**: Label lebih kecil untuk desktop */
                margin-bottom: 0.4rem; /* Sedikit dikurangi */
            }
            .main-content form input, .main-content form textarea { /* Added textarea */
                padding: 0.6rem 0.9rem; /* **DIKECILKAN**: Input/textarea lebih kecil untuk desktop */
                font-size: 0.9rem; /* **DIKECILKAN**: Font input/textarea lebih kecil untuk desktop */
            }
            .main-content form button[type="submit"] {
                padding: 0.6rem 1.2rem; /* **DIKECILKAN**: Tombol submit lebih kecil untuk desktop */
                font-size: 0.9rem; /* **DIKECILKAN**: Font tombol submit lebih kecil untuk desktop */
                width: auto; /* Kembali ke auto */
            }
            .main-content .mb-4 {
                margin-bottom: 0.8rem; /* **DIKECILKAN**: Kurangi margin-bottom antar field untuk desktop */
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
            <a href="{{ route('super-admin.users.index') }}" class="sidebar-item {{ Request::routeIs('super-admin.users.index') || Request::routeIs('super-admin.users.create') || Request::routeIs('super-admin.users.edit') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Kelola User
            </a>

            {{-- Link untuk Kelola Stasi - INI ADALAH ITEM AKTIF UNTUK HALAMAN INI --}}
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
    {{-- Removed items-center from here to keep the main header on the left --}}
    <div class="flex-grow p-6 md:p-10 main-content flex flex-col">
        <header class="main-app-header bg-white rounded-xl shadow-lg flex items-center justify-between mb-8 w-full"> {{-- Removed max-w-4xl from header --}}
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-extrabold text-gray-800">Tambah Stasi Baru</h1>
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
            {{-- Added mx-auto to center this alert box as well --}}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md w-full max-w-xl mx-auto" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Added mx-auto to center the form box --}}
        <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect w-full max-w-xl mx-auto">
            <header class="flex items-center justify-between pb-4 border-b border-gray-200 mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Form Tambah Stasi</h2>
                <a href="{{ route('super-admin.stasi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out shadow-md">
                    Kembali ke Daftar Stasi
                </a>
            </header>

            <form action="{{ route('super-admin.stasi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Stasi:</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                    @error('nama')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat (Opsional):</label>
                    <textarea id="alamat" name="alamat" rows="3" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Jika ada kolom telepon di database dan model Anda, tambahkan baris ini --}}
                {{--
                <div class="mb-4">
                    <label for="telepon" class="block text-gray-700 text-sm font-bold mb-2">Telepon (Opsional):</label>
                    <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
                    @error('telepon')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                --}}
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out shadow-md">
                        Tambah Stasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk mendapatkan lebar scrollbar
        function getScrollbarWidth() {
            const outer = document.createElement('div');
            outer.style.visibility = 'hidden';
            outer.style.overflow = 'scroll'; // Memaksa scrollbar
            outer.style.msOverflowStyle = 'scrollbar'; // Untuk IE
            document.body.appendChild(outer);
            const inner = document.createElement('div');
            outer.appendChild(inner);
            const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);
            outer.parentNode.removeChild(outer);
            return scrollbarWidth;
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
                // Saat sidebar terbuka, tambahkan kelas overflow-hidden-active dan atur lebar scrollbar
                const scrollbarWidth = getScrollbarWidth();
                document.documentElement.style.setProperty('--scrollbar-width', `${scrollbarWidth}px`);
                body.classList.add('overflow-hidden-active');
            } else {
                // Saat sidebar tertutup, hapus kelas dan reset properti CSS
                body.classList.remove('overflow-hidden-active');
                document.documentElement.style.removeProperty('--scrollbar-width');
            }
        }

        // Close sidebar if window is resized above mobile breakpoint
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;

            if (window.innerWidth >= 768) { // Tailwind's 'md' breakpoint
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('overflow-hidden-active'); // Pastikan dihapus juga
                document.documentElement.style.removeProperty('--scrollbar-width'); // Pastikan dihapus juga
            }
        });
    </script>
</body>
</html>