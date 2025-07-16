<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stasi - Super Admin</title>
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
            overflow-x: hidden; /* Mencegah overflow horizontal */
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

        /* HEADER APLIKASI UTAMA (YANG DI ATAS DENGAN BURGER BUTTON) */
        .app-header { /* New class for the main app header */
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.5rem; /* Default padding for desktop */
            margin-bottom: 2rem; /* Default margin-bottom for desktop */
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* shadow-lg */
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

        /* Main App Header on Mobile */
        .main-app-header { /* Use a specific class for the main header */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10; /* Ensure header is above main content */
            background-color: white; /* Ensure header has a background */
            padding: 0.75rem 1rem; /* Adjusted header padding for mobile to be slightly larger for content */
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
            /* Remove mb-8 from here on mobile, as it's now fixed */
            margin-bottom: 0 !important; /* Override desktop margin-bottom */
        }
        .main-app-header h1 {
            font-size: 1rem; /* Larger font size for main mobile header title */
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
        .main-app-header .desktop-welcome {
            display: none; /* Hide desktop welcome on mobile */
        }
        #burger-btn {
            z-index: 22; /* Ensure burger button is clickable above sidebar */
        }

        /* Main content adjustments for mobile */
        .main-content {
            /* Padding top added to create space for the fixed header */
            margin-top:1.5rem; /* This is the key change: 3.5rem (approx header height) + 1rem (desired gap) */
            padding-left: 0.75rem; /* Apply existing mobile padding */
            padding-right: 0.75rem; /* Apply existing mobile padding */
            padding-bottom: 0.75rem; /* Apply existing mobile padding */
            background-color: #f3f4f6; /* bg-gray-100 */
            min-height: calc(100vh - 4.5rem); /* Adjust min-height to account for padding-top */
            width: 100%; /* Important for flex-grow in mobile */
            /* Remove desktop flex properties for mobile */
            display: block; /* Override display:flex from desktop */
            align-items: initial; /* Override align-items from desktop */
        }

        /* Form element sizing for mobile */
        .bg-white.p-8 { /* Targeting the form card */
            padding: 1rem; /* Padding kartu form lebih kecil */
            border-radius: 0.75rem; /* Slightly smaller border-radius for consistency */
        }
        .bg-white.p-8 header h2.text-2xl { /* Judul di dalam kartu form (e.g., Edit User) */
            font-size: 1.125rem; /* text-lg for title inside form card */
            margin-bottom: 0.75rem; /* Adjust margin */
        }
        .bg-white.p-8 header a.py-2.px-4 { /* Tombol "Kembali ke Daftar User" */
            padding: 0.35rem 0.75rem; /* Padding tombol "Kembali" lebih kecil */
            font-size: 0.7rem; /* Font tombol "Kembali" lebih kecil */
            border-radius: 0.5rem; /* Smaller border-radius for button */
        }
        .main-content form label {
            font-size: 0.6rem; /* Smaller font for labels */
            margin-bottom: 0.4rem; /* Adjust margin */
        }
        .main-content form input, .main-content form select {
            padding: 0.4rem 0.6rem; /* Input padding even smaller */
            font-size: 0.6rem; /* Smaller font for inputs/selects */
            border-radius: 0.5rem; /* Smaller border-radius for inputs */
        }
        .main-content form button {
            padding: 0.4rem 0.9rem; /* Button padding even smaller */
            font-size: 0.6rem; /* Smaller font for buttons */
            border-radius: 0.5rem; /* Smaller border-radius for button */
        }
        .main-content .text-xs.italic {
            font-size: 0.6rem; /* Even smaller font for error messages */
        }
        .main-content .text-gray-600.text-xs.italic {
            font-size: 0.6rem; /* Even smaller font for helper text */
        }
        /* Adjust error alert for mobile */
        .bg-red-100.border.border-red-400.text-red-700 {
            padding: 0.75rem 0.75rem; /* Smaller padding for alert */
            font-size: 0.6rem; /* Smaller font for alert text */
        }
        .bg-red-100.border.border-red-400.text-red-700 strong {
            font-size: 0.6rem; /* Slightly smaller font for strong text in alert */
        }
        .bg-red-100.border.border-red-400.text-red-700 ul {
            margin-top: 0.5rem;
        }
        .bg-red-100.border.border-red-400.text-red-700 ul li {
            font-size: 0.5rem; /* Smaller font for list items in alert */
        }
    }

        /* Desktop specific styles - reset mobile overrides */
      @media (min-width: 768px) {
        html {
            padding-right: 0 !important; /* Remove scrollbar compensation */
        }
        body {
            padding-top: 0 !important; /* Reset body padding for desktop */
        }
        /* Header untuk desktop - kembali ke perilaku normal */
          header.main-app-header { /* Menggunakan kelas yang lebih spesifik */
                position: relative !important; /* Reset ke relative di desktop */
                padding: 0.75rem 1.5rem !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
                margin-bottom: 2rem !important;
                margin-top:2.5rem;
            }
            header.main-app-header h1 {
                font-size: 1.75rem !important;
            }
            header.main-app-header .mobile-welcome {
                display: none !important;
            }
            header.main-app-header .desktop-welcome {
                display: flex !important;
                align-items: center;
            }
            header.main-app-header .desktop-welcome span {
                font-size: 0.95rem;
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

        /* Main content adjustments for desktop */
        .main-content {
            padding: 1.5rem 2rem; /* Padding konten utama desktop */
            padding-top: 0; /* Reset padding-top untuk desktop */
            margin-top: 0; /* Reset margin-top */
            flex-grow: 1; /* Ambil sisa ruang */
            min-height: 100vh; /* Pastikan tinggi penuh */
            /* Remove mobile specific flex properties */
            display: block; /* Override display:flex that was accidentally added earlier */
            align-items: initial; /* Reset align-items */
        }

        /* Judul "Edit User" di dalam card */
        .bg-white.p-8 {
            padding: 2rem; /* Original padding */
            max-width: 600px; /* Set a maximum width for the form (adjust as desired) */
            width: 100%; /* Ensure it scales down on smaller desktop screens */
            margin-left: auto; /* Center the block element */
            margin-right: auto; /* Center the block element */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .bg-white.p-8 header { /* Header internal di dalam card */
            display: flex;
            flex-wrap: wrap; /* Allow wrap if too narrow */
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem; /* Bottom margin */
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }
        .bg-white.p-8 header h2 {
            font-size: 1.5rem; /* Ukuran judul di dalam kartu form desktop */
            margin-bottom: 0.5rem; /* Bottom margin if wrapped */
        }
        .bg-white.p-8 header a.py-2.px-4 {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            white-space: nowrap; /* Ensure button doesn't break line */
        }
        .main-content form label {
            font-size: 1rem; /* Reset to default desktop size */
        }
        .main-content form input, .main-content form select {
            padding: 0.75rem 1rem; /* Reset to default desktop size */
            font-size: 1rem; /* Reset to default desktop size */
        }
        .main-content form button {
            padding: 0.75rem 1.5rem; /* Reset to default desktop size */
            font-size: 1rem; /* Reset to default desktop size */
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

    {{-- Main Content Wrapper (Used for flex layout) --}}
    <div class="flex-grow p-6 md:p-10 main-content">
        {{-- App Header (fixed on mobile, relative on desktop) --}}
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8 main-app-header"> {{-- Menggunakan kelas baru 'app-header' --}}
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                {{-- Judul Halaman ini akan tampil di mobile dan desktop --}}
                <h1 class="text-4xl font-extrabold text-gray-800">Edit Stasi: {{ $stasi->nama }}</h1>
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

        {{-- Main Content Area --}}
        <div class="flex-grow p-6 md:p-10 main-content">
            {{-- Judul halaman untuk Desktop (sudah dipindahkan ke app-header) --}}
            {{-- <h1 class="text-4xl font-extrabold text-gray-800 mb-8 hidden md:block">Edit Stasi: {{ $stasi->nama }}</h1> --}}

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
                {{-- Header untuk card form (bukan header aplikasi utama) --}}
                 <header class="flex items-center justify-between pb-4 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800">Form Edit Stasi</h2>
                    <a href="{{ route('super-admin.stasi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out shadow-md">
                        Kembali ke Daftar Stasi
                    </a>
                    </header>

                <form action="{{ route('super-admin.stasi.update', $stasi->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Penting: Gunakan metode PUT untuk update --}}

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Stasi:</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $stasi->nama) }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                        @error('nama')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat (Opsional):</label>
                        <textarea id="alamat" name="alamat" rows="3" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">{{ old('alamat', $stasi->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Jika ada kolom telepon di database dan model Anda, tambahkan baris ini --}}
                    {{--
                    <div class="mb-4">
                        <label for="telepon" class="block text-gray-700 text-sm font-bold mb-2">Telepon (Opsional):</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $stasi->telepon) }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
                        @error('telepon')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    --}}
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out shadow-md">
                            Perbarui Stasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mendapatkan lebar scrollbar
        function getScrollbarWidth() {
            // Membuat elemen div sementara
            const outer = document.createElement('div');
            outer.style.visibility = 'hidden';
            outer.style.overflow = 'scroll'; // Memaksa scrollbar
            outer.style.msOverflowStyle = 'scrollbar'; // Untuk IE
            document.body.appendChild(outer);

            // Membuat inner div untuk mengukur lebar scrollbar
            const inner = document.createElement('div');
            outer.appendChild(inner);

            const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

            // Menghapus elemen sementara
            outer.parentNode.removeChild(outer);

            return scrollbarWidth;
        }

        // Simpan lebar scrollbar global
        const scrollbarWidth = getScrollbarWidth();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            // Tangani overflow-hidden dan padding-right untuk mencegah jump layout
            if (sidebar.classList.contains('active')) {
                body.classList.add('overflow-hidden');
                // Hanya tambahkan padding-right jika ada scrollbar
                if (body.scrollHeight > body.clientHeight) {
                    body.style.paddingRight = `${scrollbarWidth}px`;
                }
            } else {
                body.classList.remove('overflow-hidden');
                body.style.paddingRight = ''; // Hapus padding
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
                body.classList.remove('overflow-hidden');
                body.style.paddingRight = ''; // Pastikan padding direset
            }
        });

        // Set initial padding-top for main-content based on app-header height on load for mobile
        window.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 768) {
                const appHeader = document.querySelector('.app-header');
                const mainContent = document.querySelector('.main-content');
                if (appHeader && mainContent) {
                    // Adjust padding-top dynamically if needed, though fixed value might be enough for consistent header height
                    // const headerHeight = appHeader.offsetHeight;
                    // mainContent.style.paddingTop = `${headerHeight}px`;
                }
            }
        });
    </script>
</body>
</html>