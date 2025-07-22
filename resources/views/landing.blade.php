<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Paroki Santo Yoseph Sidareja</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan gambar background yang menutupi bagian hero pertama */
        .hero-section {
            background-image: url('{{ asset('images/landing.jpg') }}');
            height: 70vh; /* Default height */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Added for flex positioning of content inside hero */
            display: flex;
            flex-direction: column;
            position: relative; /* Needed for absolute positioning of overlay */
            min-height: 250px; /* Added min-height for very short screens */
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2); /* **DIUBAH**: Dikurangi menjadi 0.2 untuk overlay yang lebih terang */
            filter: blur(5px); /* Adjust the blur radius (5px) for more or less blur */
            z-index: 0; /* Place the overlay behind the hero content */
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .text-with-custom-shadow {
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); /* Changed to a more neutral black shadow */
        }

        /* Style untuk efek hover pada card */
        .card-hover-effect {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Overlay untuk teks agar lebih terbaca */
        .overlay-text-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent black overlay for readability */
            z-index: 0; /* Behind the content, above the image */
        }

        /* Dropdown specific styles */
        .dropdown-menu {
            position: absolute;
            /* **PERUBAHAN KRUSIAL:** Set top secara eksplisit agar tidak menempel ke navbar */
            /* Disesuaikan agar posisinya di bawah navbar dan tidak menutupi konten */
            top: calc(100% + 15px); /* Meningkatkan jarak menjadi 15px dari navbar */
            right: 0; /* Tetap di kanan */
            background-color: rgba(30, 58, 138, 0.9);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
            max-height: 0;
            opacity: 0;
            z-index: 50;
            width: max-content;
            min-width: 150px;
            padding: 0;
            /* Pastikan display none secara default untuk menyembunyikan sebelum transisi */
            display: none;
        }

        .dropdown-menu.active {
            max-height: 180px; /* Diperluas untuk menampung item "Informasi" */
            opacity: 1;
            padding: 0.4rem 0;
            display: flex; /* Aktifkan display flex saat aktif */
            flex-direction: column; /* Pastikan item vertikal */
        }

        .dropdown-menu a {
            display: block;
            padding: 0.4rem 1rem;
            color: white;
            text-decoration: none;
            transition: background-color 0.2s;
            font-size: 0.9rem;
            line-height: 1.2;
        }

        .dropdown-menu a:hover {
            background-color: rgba(49, 130, 206, 0.9);
        }
        /* Style untuk panah dropdown */
        #dropdown-arrow {
            transition: transform 0.3s ease;
        }

        #dropdown-arrow.rotate-180 {
            transform: rotate(180deg);
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) { /* Adjustments for screens smaller than 'md' breakpoint */
            .hero-section {
                height: 40vh; /* Make hero section a bit shorter on mobile (perkecil gambar bagian pertama) */
            }

            /* Navbar Adjustments */
            nav {
                padding: 0.75rem 1rem; /* Adjust padding for mobile navbar */
                z-index: 40; /* **PERUBAHAN:** Pastikan navbar memiliki z-index yang lebih tinggi */
            }
            .navbar-brand img {
                height: 2rem; /* Slightly smaller logo on mobile */
                width: 2rem;
                margin-right: 0.5rem; /* Reduce margin */
            }
            .navbar-brand span {
                font-size: 0.7rem; /* Smaller font for brand name on mobile */
                white-space: normal; /* Allow wrapping of brand name */
                line-height: 1.2; /* Adjust line height for wrapped text */
                text-align: left; /* Align text left */
            }
            .navbar-desktop-nav {
                display: none; /* Hide desktop nav links on mobile */
            }
            .navbar-mobile-nav {
                display: flex; /* Show mobile nav on mobile */
                align-items: center;
                justify-content: flex-end; /* Align items to the right */
                position: relative; /* For dropdown positioning */
                flex-grow: 1; /* Allow it to take available space */
            }
            .navbar-mobile-nav .login-button { /* Target login button inside mobile nav specifically */
                padding: 0.3rem 0.6rem; /* Smaller padding for button */
                font-size: 0.5rem; /* Smaller font for button */
                white-space: nowrap; /* Prevent button text wrapping */
            }
            .mobile-dropdown-toggle {
                cursor: pointer;
                display: flex;
                align-items: center;
                color: white;
                margin-right: 0.5rem; /* Reduced space between dropdown toggle and login button */
                white-space: nowrap; /* Prevent text and icon from wrapping */
                padding: 8px 12px; /* Tambahkan padding agar lebih mudah diklik */
                background-color: rgba(255, 255, 255, 0.1); /* Sedikit latar belakang agar terlihat */
                border-radius: 9999px; /* Bentuk pil */
                outline: none; /* Remove default outline */
                transition: all 0.2s ease-in-out;
            }
            .mobile-dropdown-toggle:focus {
                box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5), 0 0 0 4px rgba(252, 211, 77, 0.75); /* yellow-400, opacity-75 */
            }

            /* **PERUBAHAN KRUSIAL:** Posisi dropdown untuk mobile */
            .dropdown-menu {
                top: calc(100% + 15px); /* Atur posisi dropdown di bawah navbar, sama dengan di atas */
                right: 1rem; /* Beri jarak dari sisi kanan layar */
                left: auto; /* Pastikan tidak ada konflik dengan left:0 */
                z-index: 50; /* **PERUBAHAN:** Pastikan dropdown memiliki z-index yang lebih tinggi */
            }

            /* Hero Text Adjustments */
            .overlay-text {
                padding: 1rem; /* Reduce padding on mobile */
                z-index: 10; /* **PERUBAHAN:** Teks selamat datang harus di bawah dropdown, tapi di atas overlay */
            }
            .overlay-text h1 {
                font-size: 1rem; /* Adjust h1 font size for mobile */
                margin-bottom: 0.25rem; /* Reduce margin */
            }
            .overlay-text p {
                font-size: 0.7rem; /* Adjust p font size for mobile */
            }

            /* Main content section adjustments */
            .container.mx-auto {
                padding: 1rem; /* Adjust padding for container */
                margin-top: -3rem; /* Lift it up less on mobile */
            }

            /* Card adjustments */
            .grid-cols-1.md\:grid-cols-3 {
                grid-template-columns: 1fr; /* Stack cards in a single column */
            }

            /* --- START: PENYESUAIAN CARD BARU UNTUK MOBILE --- */
            /* Mengurangi padding card secara keseluruhan */
            .card-hover-effect {
                padding: 1rem; /* Mengurangi padding card di mobile dari p-6 (1.5rem) */
            }
            /* Mengurangi tinggi gambar di dalam card */
            .card-hover-effect img {
                height: 8rem; /* Mengurangi tinggi gambar di dalam card dari h-48 (12rem) */
            }
            /* Mengurangi ukuran judul card */
            .card-hover-effect h3 {
                font-size: 1.25rem; /* Mengurangi ukuran judul card dari text-2xl (1.5rem) */
                margin-bottom: 0.5rem; /* Sesuaikan margin bawah judul */
            }
            /* Mengurangi ukuran paragraf di card */
            .card-hover-effect p {
                font-size: 0.8rem; /* Mengurangi ukuran paragraf di card */
            }
            /* Mengurangi ukuran teks link "Klik Disini" di card */
            .card-hover-effect a {
                font-size: 0.8rem; /* Mengurangi ukuran teks link di card */
            }
            /* --- END: PENYESUAIAN CARD BARU UNTUK MOBILE --- */


            /* Jadwal Misa alignment for Mobile */
            .misa-entry {
                display: flex; /* Gunakan flexbox untuk setiap baris */
                justify-content: space-between; /* Menjaga teks hari di kiri dan waktu di kanan */
                width: 100%; /* Memastikan setiap baris mengambil lebar penuh */
                margin-bottom: 0.2rem; /* Jarak antar baris */
            }
            .misa-day {
                text-align: left;
                flex-basis: 55%; /* Beri ruang lebih untuk teks hari */
                font-size: 0.9rem; /* Ukuran font lebih kecil */
            }
            .misa-time {
                text-align: right; /* Jam di kanan */
                flex-basis: 45%; /* Sisa ruang untuk jam */
                font-size: 0.9rem; /* Ukuran font lebih kecil */
            }


           .footer-grid {
                text-align: center; /* Center footer content on mobile */
            }
            .footer-grid > div { /* Target direct children of footer-grid */
                display: flex;
                flex-direction: column;
                align-items: center; /* Center items in footer columns */
                text-align: center; /* Ensure text within these divs are centered */
            }
            .footer-grid p {
                text-align: center; /* Ensure text within contact and schedule sections are centered */
            }
            .footer-grid div p.flex { /* Override for flex items to center their content */
                justify-content: center;
            }
        }

        /* Desktop specific adjustments */
        @media (min-width: 768px) {
            .hero-section {
                height: 70vh; /* Restore default height for desktop */
            }
            /* Navbar Desktop specific styles */
            nav {
                padding: 1rem 2.5rem; /* Default padding for desktop navbar */
                z-index: 40; /* **PERUBAHAN:** Pastikan navbar memiliki z-index yang lebih tinggi */
            }
            .navbar-brand img {
                height: 2.5rem; /* Default desktop logo size */
                width: 2.5rem;
                margin-right: 0.75rem;
            }
            .navbar-brand span {
                font-size: 1.5rem; /* Default desktop font size */
                white-space: nowrap; /* Prevent wrapping */
            }
            .navbar-desktop-nav {
                display: flex; /* Show desktop nav links on desktop */
                align-items: center;
            }
            .navbar-mobile-nav {
                display: none; /* Hide mobile nav on desktop */
            }
            .login-button {
                padding: 0.5rem 1.5rem; /* Default desktop button padding */
                font-size: 1rem; /* Default desktop button font size */
            }
            /* Hero Text Desktop adjustments */
            .overlay-text {
                padding: 2rem;
                z-index: 10; /* **PERUBAHAN:** Teks selamat datang harus di bawah dropdown, tapi di atas overlay */
            }
            .overlay-text h1 {
                font-size: 2.5rem; /* Adjust h1 font size for desktop */
                margin-bottom: 1rem;
            }
            .overlay-text p {
                font-size: 1.25rem; /* Adjust p font size for desktop */
            }
            .footer-grid p {
                text-align: left; /* Align text left on desktop */
            }
            .footer-grid div {
                align-items: flex-start; /* Align items to start on desktop */
                text-align: left;
            }
            .footer-grid p.flex {
                justify-content: flex-start; /* Align flex items to start */
            }
            /* Jadwal Misa alignment for Desktop */
            .misa-entry {
                display: flex; /* Use flexbox for each row */
                justify-content: space-between; /* Space out day and time */
                width: 100%; /* Ensure full width */
                margin-bottom: 0.5rem; /* Jarak antar baris */
            }
            .misa-day {
                text-align: left;
                flex-basis: 50%; /* Beri ruang untuk teks hari */
                font-size: 1rem; /* Ukuran font default */
            }
            .misa-time {
                text-align: right; /* Changed to right align on desktop for better readability */
                flex-basis: 50%; /* Sisa ruang untuk jam */
                font-size: 1rem; /* Ukuran font default */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Hero Section (Bagian Atas dengan Gambar Background dan Teks Selamat Datang) --}}
    <div class="hero-section relative">
        <div class="hero-overlay"></div>
        <div class="overlay-text-container"></div>

        {{-- Navbar Sederhana dengan Logo dan Tombol Login --}}
        <nav class="bg-blue-900 p-4 text-white flex justify-between items-center relative z-40 shadow-md">
            {{-- Logo Paroki dan Nama Paroki --}}
            <div class="flex items-center navbar-brand">
                <a href="{{ route('landing') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-10 w-10 mr-3 rounded-full border border-white">
                    <span class="text-xl md:text-2xl font-bold">PAROKI SANTO YOSEPH SIDAREJA</span>
                </a>
            </div>

            {{-- Bagian Kanan Navbar (Desktop) --}}
            <div class="hidden md:flex items-center space-x-6 navbar-desktop-nav">
                <a href="{{ route('landing') }}" class="underline text-yellow-300 hover:text-yellow-400 transition-colors duration-200">Beranda</a>
                <a href="{{ route('profil-gereja') }}" class="hover:text-yellow-400 transition-colors duration-200">Profil Gereja</a>
                <a href="{{ route('kegiatan-agenda') }}" class="hover:text-yellow-400 transition-colors duration-200">Kegiatan/Agenda</a>
                <a href="{{ route('galeri') }}" class="hover:text-yellow-400 transition-colors duration-200">Galeri</a>
                {{-- Tambahkan Navbar untuk Halaman Informasi --}}
                <a href="{{ route('informasi') }}" class="hover:text-yellow-400 transition-colors duration-200">Informasi</a>
                <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button">
                    LOGIN SIKOPAR
                </a>
            </div>

            {{-- Bagian Kanan Navbar (Mobile) --}}
            <div class="md:hidden flex items-center space-x-2 relative navbar-mobile-nav flex-grow justify-end">
                {{-- Dropdown Toggle (Panah ke Bawah) --}}
                <div class="mobile-dropdown-toggle" id="mobile-dropdown-toggle" aria-haspopup="true" aria-expanded="false" tabindex="0">
                    <span class="text-white text-sm mr-1">Menu</span>
                    <svg class="w-4 h-4 text-white transform transition-transform duration-300" id="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                {{-- Tombol Login untuk Mobile --}}
                <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button">
                    LOGIN SIKOPAR
                </a>

                {{-- Dropdown Menu --}}
                <div id="mobile-dropdown-menu" class="dropdown-menu" role="menu" aria-labelledby="mobile-dropdown-toggle">
                    <a href="{{ route('landing') }}" class="dropdown-item underline text-yellow-300 bg-blue-700 hover:text-yellow-400" role="menuitem">Beranda</a>
                    <a href="{{ route('profil-gereja') }}" class="dropdown-item" role="menuitem">Profil Gereja</a>
                    <a href="{{ route('kegiatan-agenda') }}" class="dropdown-item" role="menuitem">Kegiatan/Agenda</a>
                    <a href="{{ route('galeri') }}" class="dropdown-item" role="menuitem">Galeri</a>
                    {{-- Tambahkan item "Informasi" di dropdown mobile --}}
                    <a href="{{ route('informasi') }}" class="dropdown-item" role="menuitem">Informasi</a>
                </div>
            </div>
        </nav>
        {{-- Content Teks Selamat Datang di atas gambar --}}
        <main class="flex-grow flex mt-12 justify-center p-4 relative z-10">
            <div class="text-center text-white overlay-text shadow-xl max-w-2xl mx-auto">
                <h1 class="text-2xl md:text-4xl font-bold mb-4 text-with-custom-shadow">Selamat Datang Di Website</h1>
                <p class="text-1xl md:text-xl font-semibold text-with-custom-shadow">Gereja Paroki Santo Yoseph Sidareja</p>
            </div>
        </main>
    </div>

    {{-- Konten Utama yang Bisa Di-scroll (Di Bawah Hero Section) --}}
    <div class="container mx-auto p-6 md:p-10 bg-gray-100 -mt-20 relative z-20 rounded-t-xl shadow-lg">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            {{-- Card Jadwal Misa --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col card-jadwal-misa">
                {{-- Changed h-48 to h-40 for smaller height --}}
                <img src="{{ asset('images/jadwal_misa_card.jpg') }}" alt="Jadwal Misa" class="w-full h-40 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Jadwal Misa</h3>
                <div class="misa-times flex-grow">
                    {{-- Setiap jadwal misa adalah satu baris flexbox --}}
                    <div class="misa-entry">
                        <h5 class="misa-day">Senin-Jumat</h5>
                        <h5 class="misa-time">05 . 30</h5>
                    </div>
                    <div class="misa-entry">
                        <h5 class="misa-day">Sabtu</h5>
                        <h5 class="misa-time">18 . 00</h5>
                    </div>
                    <div class="misa-entry">
                        <h5 class="misa-day">Minggu</h5>
                        <h5 class="misa-time">07 . 00</h5>
                    </div>
                </div>
                {{-- Arahkan ke halaman informasi --}}
                <a href="{{ route('informasi') }}" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>

            {{-- Card Pengumuman --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col">
                {{-- Changed h-48 to h-40 for smaller height --}}
                <img src="{{ asset('images/pengumuman_card.jpg') }}" alt="Pengumuman" class="w-full h-40 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Pengumuman</h3>
                <p class="text-gray-700 mb-4 flex-grow">
                    "Pengumman Minggu ini belum dibuat. Silahkan cek kembali nanti untuk melihat pengumuman terbaru."
                </p>
                {{-- Arahkan ke halaman informasi --}}
                <a href="{{ route('informasi') }}" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>

            {{-- Card Tentang Gereja --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col">
                {{-- Changed h-48 to h-40 for smaller height --}}
                <img src="{{ asset('images/tentang_gereja_card.jpg') }}" alt="Tentang Gereja" class="w-full h-40 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tentang Gereja</h3>
                <p class="text-gray-700 mb-4 flex-grow">
                    "Gereja Santo Yoseph yang bernama resmi Gereja Paroki Santo Yoseph, Sidareja adalah sebuah gereja paroki Katolik yang terletak di Kabupaten Cilacap, Jawa Tengah, Indonesia. Gereja ini didedikasikan kepada Santo Yoseph. Gereja ini berada di bawah naungan yurisdiksi Keuskupan Purwokerto.
                </p>
                <a href="{{ route('profil-gereja') }}" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>
        </section>

        {{-- Bagian Agenda Mendatang --}}
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-blue-800 mb-8 text-center md:text-left">Agenda Mendatang</h2>
            <div class="space-y-6">
                {{-- Agenda 1: Misa Jumat Pertama --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 card-hover-effect">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Misa Jumat Pertama</h3>
                    <p class="text-gray-600 mb-1">Tanggal: 5 Juli 2025</p>
                    <p class="text-gray-600 mb-3">Waktu: 18.00 WIB</p>
                    <p class="text-gray-700">Bertempat di Gereja Paroki Santo Yoseph Sidareja. Mari hadir dalam Ekaristi khusus ini.</p>
                </div>

                {{-- Agenda 2: Pertemuan Lingkungan St. Petrus --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 card-hover-effect">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pertemuan Lingkungan St. Petrus</h3>
                    <p class="text-gray-600 mb-1">Tanggal: 12 Juli 2025</p>
                    <p class="text-gray-600 mb-3">Waktu: 19.00 WIB</p>
                    <p class="text-gray-700">Agenda: Pembahasan persiapan Peringatan HUT Paroki. Lokasi akan diumumkan lebih lanjut oleh Ketua Lingkungan.</p>
                </div>

                {{-- Agenda 3: Rekoleksi OMK Paroki --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 card-hover-effect">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Rekoleksi OMK Paroki</h3>
                    <p class="text-gray-600 mb-1">Tanggal: 20 Juli 2025</p>
                    <p class="text-gray-600 mb-3">Waktu: 09.00 - 15.00 WIB</p>
                    <p class="text-gray-700">Tema: "Bertumbuh dalam Iman di Era Digital". Peserta diharapkan mendaftar melalui koordinator OMK.</p>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('kegiatan-agenda') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-lg">Lihat Semua Agenda &rarr;</a>
            </div>
        </section>

        {{-- Bagian Galeri Foto --}}
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-blue-800 mb-8 text-center md:text-left">Galeri Foto Paroki</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Galeri Item 1: Perayaan Natal 2024 --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/natal2024.jpg') }}" alt="Perayaan Natal 2024" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Perayaan Natal 2024</h3>
                        <p class="text-gray-600 text-sm mt-1">Foto-foto kemeriahan perayaan Natal tahun 2024.</p>
                    </div>
                </div>

                {{-- Galeri Item 2: Misa Minggu Paskah --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/paskah.jpg') }}" alt="Misa Minggu Paskah" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Misa Minggu Paskah</h3>
                        <p class="text-gray-600 text-sm mt-1">Perayaan Ekaristi Minggu Paskah di Paroki Santo Yoseph.</p>
                    </div>
                </div>

                {{-- Galeri Item 3: Komuni Pertama --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/komunipertama.jpg') }}" alt="Komuni Pertama" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Komuni Pertama</h3>
                        <p class="text-gray-600 text-sm mt-1">Momen istimewa penerimaan Komuni Pertama bagi anak-anak.</p>
                    </div>
                </div>

                 {{-- Galeri Item 4: Pelantikan Misdinar --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/pelantikan.jpg') }}" alt="Pelantikan Misdinar" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Pelantikan Misdinar</h3>
                        <p class="text-gray-600 text-sm mt-1">Upacara pelantikan misdinar baru di gereja.</p>
                    </div>
                </div>

                {{-- Galeri Item 5: Ziarah OMK --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/ziarahomk.jpg') }}" alt="Ziarah OMK" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ziarah OMK</h3>
                        <p class="text-gray-600 text-sm mt-1">Kegiatan ziarah Orang Muda Katolik Paroki.</p>
                    </div>
                </div>

                {{-- Galeri Item 6: Ziarah Wonosobo --}}
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover-effect">
                    <img src="{{ asset('images/ziarahwonosobo.jpg') }}" alt="Ziarah Wonosobo" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ziarah Wonosobo</h3>
                        <p class="text-gray-600 text-sm mt-1">Perjalanan ziarah ke Wonosobo.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('galeri') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-lg">Lihat Semua Galeri &rarr;</a>
            </div>
        </section>
    </div>

    {{-- Footer --}}
    <footer class="bg-blue-950 text-gray-200 py-10">
        <div class="container mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-8 footer-grid">
            {{-- Logo dan Nama Paroki di Footer --}}
            <div class="flex flex-col items-center text-center footer-brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-20 w-20 mb-4 rounded-full border-2 border-gray-400">
                <h2 class="text-lg font-semibold text-gray-50 ">PAROKI SANTO YOSEPH</h2>
                <h2 class="text-lg font-semibold text-gray-50">SIDAREJA</h2>
            </div>

            {{-- Kontak Kami --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-50">Kontak Kami</h4>
                <p class="flex items-center mb-2 justify-center md:justify-start">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 9a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    Jl Ranggaesera No. 596, Sidareja - Cilacap 53213, Jawa Tengah
                </p>
                <p class="flex items-center mb-2 justify-center md:justify-start">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.956.7L6.5 6H8V3a1 1 0 011-1h4a1 1 0 011 1v3h1.347l.391-2.3A1 1 0 0117 2h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1v-4.153a1 1 0 01-.7-.956L14.5 14H12v3a1 1 0 01-1 1H7a1 1 0 01-1-1v-3H4.653l-.391 2.3A1 1 0 013 18H2a1 1 0 01-1-1V3a1 1 0 011-1zM5 4h10v2H5V4zm0 4h10v2H5V8zm0 4h10v2H5v-2z" clip-rule="evenodd" fill-rule="evenodd"></path><path d="M3 8a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1V8z"></path></svg>
                    (0280) 523896
                </p>
                <p class="flex items-center justify-center md:justify-start">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    paroki.santosyoseph@gmail.com
                </p>
            </div>

            {{-- Jadwal Buka Sekretariat --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-50">Jadwal Buka Sekretariat</h4>
                <p class="mb-1 text-gray-300">Senin - Jumat</p>
                <p class="text-sm text-gray-400 mb-3">08.00 - 15.00</p>
                <p class="mb-1 text-gray-300">Sabtu - Minggu</p>
                <p class="text-sm text-gray-400">Tutup</p>
            </div>

            {{-- Peta Situs (Diubah agar sama dengan Navbar) --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-50">Peta Situs</h4>
                <ul class="text-gray-300">
                    <li class="mb-2"><a href="{{ route('landing') }}" class="hover:text-white transition-colors duration-200 focus:text-white focus:outline-none">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('profil-gereja') }}" class="hover:text-white transition-colors duration-200 focus:text-white focus:outline-none">Profil Gereja</a></li>
                    <li class="mb-2"><a href="{{ route('kegiatan-agenda') }}" class="hover:text-white transition-colors duration-200 focus:text-white focus:outline-none">Kegiatan/Agenda</a></li>
                    <li class="mb-2"><a href="{{ route('galeri') }}" class="hover:text-white transition-colors duration-200 focus:text-white focus:outline-none">Galeri</a></li>
                    {{-- Tambahkan link Informasi ke footer --}}
                    <li class="mb-2"><a href="{{ route('informasi') }}" class="hover:text-white transition-colors duration-200 focus:text-white focus:outline-none">Informasi</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 text-center text-gray-500 text-sm border-t border-gray-800 pt-6">
            &copy; Created by Stefanus Cecilio 2025 Paroki Santo Yoseph Sidareja.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownToggle = document.getElementById('mobile-dropdown-toggle');
            const dropdownMenu = document.getElementById('mobile-dropdown-menu');
            const dropdownArrow = document.getElementById('dropdown-arrow');

            if (dropdownToggle && dropdownMenu && dropdownArrow) {
                dropdownToggle.addEventListener('click', function () {
                    const isExpanded = dropdownMenu.classList.contains('active');
                    dropdownMenu.classList.toggle('active');
                    dropdownArrow.classList.toggle('rotate-180');
                    dropdownToggle.setAttribute('aria-expanded', !isExpanded); // Update aria-expanded
                });

                // Close dropdown if clicked outside
                document.addEventListener('click', function (event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.remove('active');
                        dropdownArrow.classList.remove('rotate-180');
                        dropdownToggle.setAttribute('aria-expanded', 'false'); // Set aria-expanded to false
                    }
                });

                // Close dropdown if escape key is pressed
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && dropdownMenu.classList.contains('active')) {
                        dropdownMenu.classList.remove('active');
                        dropdownArrow.classList.remove('rotate-180');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                        dropdownToggle.focus(); // Return focus to the toggle button
                    }
                });
            }
        });
    </script>
</body>
</html>