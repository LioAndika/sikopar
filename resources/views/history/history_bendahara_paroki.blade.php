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
        
            /* Adjust filter form layout for mobile */
            .filter-form-grid {
                grid-template-columns: 1fr; /* Stack columns on mobile */
                gap: 1rem; /* Smaller gap for mobile */
            }
            .filter-buttons {
                flex-direction: column; /* Stack buttons vertically */
                gap: 0.5rem; /* Space between stacked buttons */
                align-items: stretch; /* Make buttons full width */
            }
            .filter-buttons button,
            .filter-buttons a {
                width: 100%; /* Full width buttons */
                text-align: center; /* Center text in buttons */
                padding-left: 1rem; /* Adjust padding for smaller screens */
                padding-right: 1rem; /* Adjust padding for smaller screens */
            }

            /* Table specific adjustments for mobile */
            .responsive-table {
                font-size: 0.75rem; /* Smaller font for table on mobile */
            }
            .responsive-table th,
            .responsive-table td {
                padding: 0.5rem 0.75rem; /* Smaller padding for table cells */
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
        
            .filter-form-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Reset to desktop grid */
                gap: 1rem;
            }
            .filter-buttons {
                flex-direction: row; /* Buttons side-by-side on desktop */
                gap: 0.5rem; /* Space between buttons */
                justify-content: flex-end; /* Align buttons to the end */
                align-items: center;
            }
            .filter-buttons button,
            .filter-buttons a {
                width: auto; /* Auto width for buttons */
                text-align: left; /* Reset text align */
            }
            .responsive-table {
                font-size: 0.875rem; /* Default font size for desktop table */
            }
            .responsive-table th,
            .responsive-table td {
                padding: 0.75rem 1.5rem; /* Default padding for desktop table cells */
            }
        }

        /* --- PRINT STYLES --- */
          @media screen {
                .knowing-text {
                display: none !important;
                }}
        @media print {
            body {
        font-size: 10px;
        background: white;
    }


    /* Atur margin agar rapi di print */
    @page {
        margin: 1cm;
    }
            .knowing-text {
            display: block !important;
            }

            /* Hide elements not needed for printing */
            .sidebar-container,
            #sidebar-overlay,
            header,
            .filter-form-grid, /* Hide the filter form */
            .filter-buttons, /* Hide filter buttons */
            .pagination, /* Hide pagination links */
            .print-hidden /* Any element with this class will be hidden */
             {
                display: none !important;
            }

            /* Show only the main content area for printing */
            .main-content {
                width: 100% !important;
                padding: 0 !important; /* Remove padding for full width print */
                margin: 0 !important; /* Remove margins */
                min-height: auto; /* Allow content to dictate height */
            }

            /* Adjust the card containing the table to fit print layout */
            .bg-white.p-4.md\:p-8.rounded-xl.shadow-lg.mb-8.card-hover-effect {
                box-shadow: none !important; /* Remove box shadow */
                border: none !important; /* Remove border */
                padding: 0 !important; /* Remove padding */
                margin: 0 !important; /* Remove margins */
            }

            /* Kop Surat Styles */
            .letterhead {
                display: flex !important; /* Menggunakan flexbox untuk tata letak */
                align-items: center; /* Pusatkan secara vertikal */
                justify-content: flex-start; /* Sejajarkan ke kiri */
                margin-bottom: 20px;
                margin-top: 50px;
                padding-bottom: 10px; /* Tambahkan sedikit padding di bawah garis */
                border-bottom: 0.5px solid #ccc; /* Pindahkan garis HR ke parent */
            }

            .letterhead img {
                 max-width: 100px;
                height: auto;
                margin-right: 20px; /* Beri jarak antara logo dan teks */
                margin-bottom: 0; /* Pastikan margin-bottom tidak ada */
            }

            .letterhead-text {
                text-align: center; /* Teks rata kiri */
                margin-left:100px;
            }

            .letterhead-text h2 {
                 font-size: 14pt;
                font-weight: bold;
                margin: 0;
                color: #000;
            }

            .letterhead-text h3 {
                font-size: 1.2em; /* Ukuran font untuk keuskupan */
                margin: 0;
                color: #000;
                line-height: 1.2;
            }

            .letterhead-text p {
                font-size: 0.9em; /* Ukuran font untuk alamat */
                margin: 0;
                color: #333;
                line-height: 1.2;
            }

            /* Adjust table appearance for printing */
            .responsive-table {
                width: 100% !important;
                border-collapse: collapse !important; /* Ensure borders are collapsed */
                font-size: 10pt !important; /* Adjust font size for print */
                margin-top: 20px; /* Jarak dari kop surat */
            }

            .responsive-table th,
            .responsive-table td {
                border: 1px solid #000 !important; /* Solid black borders for print */
                padding: 6px 10px !important; /* Adjust padding for print */
                white-space: normal !important; /* Allow text to wrap */
                color: #000 !important; /* Ensure text is black */
            }
             .responsive-table th {
                background-color: #ffffffff !important; /* Light grey background for header */
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .responsive-table tfoot {
                background-color: #e0e0e0 !important; /* Slightly darker grey for footer */
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Ensure image in sidebar brand is hidden if accidentally shown */
            .sidebar-brand img {
                display: none !important;
            }

            /* Make sure h1 in main content is hidden */
            .main-content h1 {
                display: none !important;
            }

            /* Hide the Riwayat Data Kolekte heading as it's replaced by the print title */
            h3.text-xl.md\:text-2xl.font-semibold.text-gray-800.mb-5.border-b.pb-3.border-gray-200.flex.items-center {
                display: none !important;
            }

            /* Status badge specific print styles */
            .px-1\.5.py-0\.5.rounded-full.text-xs.font-semibold {
                background: transparent !important; /* Remove background for status badges */
                color: #000 !important; /* Ensure black text for status */
                border: 1px solid #ccc !important; /* Add border for definition */
                padding: 2px 5px !important;
                border-radius: 5px !important;
            }
            .text-right {
                text-align: right !important;
            }

            /* New Styles for Signatures */
            .signature-section {
                display: flex !important; /* Use flexbox to arrange signatures horizontally */
                justify-content: space-around; /* Distribute space evenly */
                width: 100%;
                margin-top: 50px; /* Space after the table */
                font-size: 10pt;
            }

            .signature-block {
                text-align: center;
                flex: 1; /* Allow blocks to take equal space */
                padding: 0 20px; /* Add some internal padding */
            }

            .signature-block .role {
                font-weight: bold;
                margin-bottom: 50px; /* Space for actual signature */
            }

            .signature-block .name {
                border-bottom: 1px solid #000; /* Underline for the name */
                padding-bottom: 2px;
                display: inline-block; /* Ensure border only covers the name */
                font-weight: bold;
            }
                 /* Gaya untuk teks "Mengetahui" di atas tanda tangan */
            .knowing-text {
                text-align: center;
                font-weight: bold;
                font-size: 9pt;
                margin-top: 20px; /* Jarak dari tanggal ke teks "Mengetahui" */
                margin-bottom: 10px; /* Jarak dari teks "Mengetahui" ke blok tanda tangan */
                display: block;
                width: 100%;
            }


            .print-date {
                text-align: right;
                margin-top: 30px;
                margin-right: 50px; /* Adjust if needed */
                font-size: 10pt;
            }

            .printed-by {
                text-align: left;
                margin-top: 10px;
                margin-left: 50px; /* Adjust if needed */
                font-size: 8pt; /* Smaller font for "Printed by" */
                color: #555;
            }

            /* Remove the card-hover-effect box-shadow and border in print */
            .bg-white.p-4.md\:p-8.rounded-xl.shadow-lg.mb-8.card-hover-effect {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Bendahara Paroki (tetap sama) --}}
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
            {{-- AKTIFKAN BARIS INI UNTUK RIWAYAT LAPORAN FINAL --}}
            {{-- UBAH NAMA RUTE DI SINI --}}
            <a href="{{ route('bendahara-paroki.laporan.history.bendahara-paroki') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.history.bendahara-paroki') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> {{-- Ikon Riwayat --}}
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
        <div class="bg-white p-4 md:p-8 rounded-xl shadow-lg mb-8 card-hover-effect">
            {{-- Kop Surat (akan ditampilkan saat dicetak) --}}
            <div class="letterhead" style="display: none;"> {{-- Awalnya tersembunyi --}}
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki">
                <div class="letterhead-text">
                    <h2>PAROKI SANTO YOSEPH SIDAREJA</h2>
                    <h3>KEUSKUPAN PURWOKERTO</h3>
                    <p>Jl. Ronggasena No. 596 Tlp. (0280) 523596</p>
                    <p>Email:parokisantoyoseph@gmail.com</p>
                    <p>Sidareja - Cilacap 53261</p>
                </div>
            </div>

            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM6.5 9.5a1 1 0 10-2 0 1 1 0 002 0zm4 0a1 1 0 10-2 0 1 1 0 002 0zm4 0a1 1 0 10-2 0 1 1 0 002 0z" clip-rule="evenodd"></path></svg>
                Riwayat Data Kolekte
            </h3>

            {{-- Form Filter dan Pencarian --}}
            <form action="{{ route('bendahara-paroki.laporan.history.bendahara-paroki') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-inner grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 items-end filter-form-grid print-hidden">
                <div>
                    <label for="search" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Cari (Nama Pengirim/Stasi)</label>
                    <input type="text" name="search" id="search" placeholder="Cari laporan..."
                           value="{{ request('search') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5 px-2">
                </div>
                <div>
                    <label for="start_date" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date"
                           value="{{ request('start_date') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5 px-2">
                </div>
                <div>
                    <label for="end_date" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date"
                           value="{{ request('end_date') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5 px-2">
                </div>
                <div>
                    <label for="stasi_id" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Filter Stasi</label>
                    <select name="stasi_id" id="stasi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5 px-2">
                        <option value="">Semua Stasi</option>
                        @foreach($stasiOptions as $stasi)
                            <option value="{{ $stasi->id }}" {{ request('stasi_id') == $stasi->id ? 'selected' : '' }}>
                                {{ $stasi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-full flex flex-col md:flex-row justify-end space-y-2 md:space-y-0 md:space-x-2 mt-4 filter-buttons">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('bendahara-paroki.laporan.history.bendahara-paroki') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586l-1.293-1.293z" />
                        </svg>
                        Reset Filter
                    </a>
                    <button type="button" onclick="window.print()" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 print-hidden">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4V2a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v8a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2h2zm0 2h10v6H5V6zm5 1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Cetak Laporan
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-6 responsive-table">
                <table class="w-full text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Tanggal Kolekte</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Jumlah Kolekte</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Stasi</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Nama Pengirim</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Status Ketua Stasi</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Status Bendahara Paroki</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Status Romo Paroki</th>
                            <th scope="col" class="py-2 px-3 md:py-3 md:px-6">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanKolektes as $laporan)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="py-2 px-3 md:py-4 md:px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_kolekte)->format('d M Y') }}
                                </td>
                                <td class="py-2 px-3 md:py-4 md:px-6">Rp {{ number_format($laporan->jumlah_kolekte, 0, ',', '.') }}</td>
                                <td class="py-2 px-3 md:py-4 md:px-6">{{ $laporan->stasi->nama ?? 'N/A' }}</td>
                                <td class="py-2 px-3 md:py-4 md:px-6">{{ $laporan->nama_pengirim }}</td>
                                <td class="py-2 px-3 md:py-4 md:px-6">
                                    <span class="px-1.5 py-0.5 rounded-full text-xs font-semibold
                                        @if($laporan->status_ketua_stasi == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_ketua_stasi == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_ketua_stasi)) }}
                                    </span>
                                </td>
                                <td class="py-2 px-3 md:py-4 md:px-6">
                                    <span class="px-1.5 py-0.5 rounded-full text-xs font-semibold
                                        @if($laporan->status_bendahara_paroki == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_bendahara_paroki == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_bendahara_paroki)) }}
                                    </span>
                                </td>
                                <td class="py-2 px-3 md:py-4 md:px-6">
                                    <span class="px-1.5 py-0.5 rounded-full text-xs font-semibold
                                        @if($laporan->status_romo_paroki == 'divalidasi') bg-green-200 text-green-800
                                        @elseif($laporan->status_romo_paroki == 'menunggu_validasi') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $laporan->status_romo_paroki)) }}
                                    </span>
                                </td>
                                <td class="py-2 px-3 md:py-4 md:px-6 max-w-[150px] truncate">{{ $laporan->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 px-6 text-center text-gray-500">Tidak ada data laporan final yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="text-sm text-gray-700 uppercase bg-gray-50 font-bold">
                        <tr>
                            <td class="py-2 px-3 md:py-3 md:px-6" colspan="2">Total Keseluruhan Kolekte:</td>
                            <td class="py-2 px-3 md:py-3 md:px-6 text-right" colspan="6">Rp {{ number_format($totalKolekte, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Tanggal Cetak dan Tanda Tangan --}}
            <div class="print-area">
                <div class="print-date">Purwokerto, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div class="knowing-text">Mengetahui,</div>
                <div class="signature-section" style="display: none;">
                    <div class="signature-block">
                        
                        <p class="signer-title">Romo Paroki</p>
                        <div class="digital-signature-box" style="border: 1px solid #ccc; width: 150px; height: 70px; margin: 10px auto; display: flex; align-items: center; justify-content: center; font-size: 0.8em; color: #777;">
                            Tanda Tangan Digital
                        </div>
                        <div class="name">RD. Andreas Surya Purnawan Br</div>
                    </div>
                    <div class="signature-block">
                        
                        <p class="signer-title">Bendahara Paroki</p>
                        <div class="digital-signature-box" style="border: 1px solid #ccc; width: 150px; height: 70px; margin: 10px auto; display: flex; align-items: center; justify-content: center; font-size: 0.8em; color: #777;">
                            Tanda Tangan Digital
                        </div>
                        <div class="name">Fransiska Unawati</div>
                    </div>
                </div>
                <div class="printed-by" style="display: none;">Printed by: {{ Auth::user()->name ?? 'N/A' }}</div>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 md:mt-6 text-sm pagination print-hidden">
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