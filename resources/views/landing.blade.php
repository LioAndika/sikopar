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
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent dark overlay - adjust alpha (0.4) for darkness */
            filter: blur(5px); /* Adjust the blur radius (5px) for more or less blur */
            z-index: 0; /* Place the overlay behind the hero content */
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .text-with-custom-shadow {
            text-shadow: 3px 3px 5px rgba(231, 220, 25, 0.7);
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

        /* Responsive Adjustments */
        @media (max-width: 767px) { /* Adjustments for screens smaller than 'md' breakpoint */
            .hero-section {
                height: 60vh; /* Make hero section a bit shorter on mobile */
            }

            /* Navbar Adjustments */
            nav {
                padding: 1rem; /* Adjust padding for mobile navbar */
            }
            .navbar-brand img {
                height: 2.5rem; /* Slightly smaller logo on mobile */
                width: 2.5rem;
                margin-right: 0.5rem; /* Reduce margin */
            }
            .navbar-brand span {
                font-size: 0.6rem; /* Smaller font for brand name on mobile */
                white-space: normal; /* Allow wrapping of brand name */
                line-height: 1.2; /* Adjust line height for wrapped text */
                text-align: left; /* Align text left */
            }
            .navbar-nav .login-button {
                padding: 0.4rem 0.4rem; /* Smaller padding for button */
                font-size: 0.4rem; /* Smaller font for button */
                white-space: nowrap; /* Prevent button text wrapping */
            }

            /* Hero Text Adjustments */
            .overlay-text {
                padding: 1rem; /* Reduce padding on mobile */
            }
            .overlay-text h1 {
                font-size: 0.8rem; /* Adjust h1 font size for mobile */
                margin-bottom: 0.25rem; /* Reduce margin */
            }
            .overlay-text p {
                font-size: 0.5rem; /* Adjust p font size for mobile */
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
                height: 10rem; /* Mengurangi tinggi gambar di dalam card dari h-48 (12rem) */
            }
            /* Mengurangi ukuran judul card */
            .card-hover-effect h3 {
                font-size: 1.5rem; /* Mengurangi ukuran judul card dari text-2xl (1.5rem) */
                margin-bottom: 0.75rem; /* Sesuaikan margin bawah judul */
            }
            /* Mengurangi ukuran paragraf di card */
            .card-hover-effect p {
                font-size: 0.9rem; /* Mengurangi ukuran paragraf di card */
            }
            /* Mengurangi ukuran teks link "Klik Disini" di card */
            .card-hover-effect a {
                font-size: 0.9rem; /* Mengurangi ukuran teks link di card */
            }
            /* --- END: PENYESUAIAN CARD BARU UNTUK MOBILE --- */


            /* Jadwal Misa alignment - STACK VERTICALLY ON MOBILE */
            .card-jadwal-misa .misa-times {
                flex-direction: column; /* Stack times vertically on mobile */
                align-items: center; /* Center horizontally */
            }
            .card-jadwal-misa .misa-times > div {
                margin: 0.5rem 0; /* Adjust vertical spacing */
                text-align: center; /* Center text within each time block */
            }
            .card-jadwal-misa .misa-times > div h5 {
                text-align: center; /* Ensure text within columns is centered */
                font-size: 1rem; /* Perkecil font untuk waktu misa */
            }


            /* Footer adjustments */
            .footer-grid {
                grid-template-columns: 1fr; /* Stack footer columns */
                text-align: center; /* Center text in footer columns */
            }
            .footer-grid > div {
                margin-bottom: 1.5rem; /* Add some space between stacked footer sections */
            }
            .footer-brand { /* Ensure vertical stack and center for footer brand */
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .footer-brand img {
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 1rem; /* Adjust margin for logo */
            }
            .footer-brand h2 {
                margin-left: auto; /* Center text below logo */
                margin-right: auto;
                font-size: 1.1rem; /* Smaller font for footer brand */
            }
            .footer-grid p, .footer-grid li {
                font-size: 0.85rem; /* Smaller font for footer text */
            }
            .footer-grid ul {
                padding-left: 0; /* Remove default ul padding */
                list-style: none; /* Remove list bullets */
            }
            .footer-grid ul li {
                margin-bottom: 0.5rem; /* Space out list items */
            }
            .footer-grid .flex.items-center {
                justify-content: center; /* Center icons with text */
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
            .login-button {
                padding: 0.5rem 1.5rem; /* Default desktop button padding */
                font-size: 1rem; /* Default desktop button font size */
            }
            /* Hero Text Desktop adjustments */
            .overlay-text {
                padding: 2rem;
            }
            .overlay-text h1 {
                font-size: 2.5rem; /* Adjust h1 font size for desktop */
                margin-bottom: 1rem;
            }
            .overlay-text p {
                font-size: 1.25rem; /* Adjust p font size for desktop */
            }
            /* Footer desktop specific styles for brand block */
            .footer-brand {
                flex-direction: column; /* Ensure vertical stack */
                align-items: center; /* Center horizontally for mobile */
                text-align: center;
            }
            .footer-brand img {
                margin-left:0;
                margin-right:0;
            }
            .footer-brand h2 {
                margin-left: 0;
                margin-right: 0;
                font-size: 1.25rem; /* Default desktop font size */
            }
            .footer-grid p, .footer-grid li {
                font-size: 1rem; /* Default desktop font size */
            }
            .footer-grid ul {
                padding-left: 1.25rem; /* Restore default ul padding */
                list-style: disc; /* Restore list bullets */
            }
            .footer-grid .flex.items-center {
                justify-content: flex-start; /* Align to start on desktop */
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
        <nav class="bg-transparent p-4 text-white flex justify-between items-center relative z-10">
            {{-- Logo Paroki dan Nama Paroki --}}
            <div class="flex items-center navbar-brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-10 w-10 mr-3 rounded-full border border-white">
                <span class="text-xl md:text-2xl font-bold">PAROKI SANTO YOSEPH SIDAREJA</span>
            </div>

            {{-- Tombol Login --}}
            <div class="navbar-nav">
                <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button">
                    LOGIN SIKOPAR
                </a>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card Jadwal Misa --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col card-jadwal-misa">
                <img src="{{ asset('images/jadwal_misa_card.jpg') }}" alt="Jadwal Misa" class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Jadwal Misa</h3>
                <div class="misa-times flex justify-center items-start">
                    <div>
                        <h5>Senin-Jumat</h5>
                        <h5>Sabtu</h5>
                        <h5>Minggu</h5>
                    </div>
                    <div>
                        <h5>05 . 30</h5>
                        <h5>18 . 00</h5>
                        <h5>07 . 00</h5>
                    </div>
                </div>
                <a href="#" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>

            {{-- Card Pengumuman --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col">
                <img src="{{ asset('images/pengumuman_card.jpg') }}" alt="Pengumuman" class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Pengumuman</h3>
                <p class="text-gray-700 mb-4 flex-grow">
                    "Haruslah kamu pelihara hari Sabat, sebab itulah hari kudus bagimu." (Kel: 31:14). Jadwal misa mingguan Paroki Santo Yoseph beserta petugasnya.
                </p>
                <a href="#" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>

            {{-- Card Tentang Gereja --}}
            <div class="bg-white p-6 rounded-xl shadow-lg card-hover-effect flex flex-col">
                <img src="{{ asset('images/tentang_gereja_card.jpg') }}" alt="Tentang Gereja" class="w-full h-48 object-cover rounded-t-lg mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tentang Gereja</h3>
                <p class="text-gray-700 mb-4 flex-grow">
                    "Haruslah kamu pelihara hari Sabat, sebab itulah hari kudus bagimu." (Kel: 31:14). Jadwal misa mingguan Paroki Santo Yoseph beserta petugasnya.
                </p>
                <a href="#" class="text-yellow-600 hover:text-yellow-800 font-semibold mt-auto">Klik Disini</a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-blue-950 text-gray-200 py-10">
        <div class="container mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-8 footer-grid">
            {{-- Logo dan Nama Paroki di Footer --}}
            <div class="flex flex-col items-center text-center footer-brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-20 w-20 mb-4 rounded-full border-2 border-gray-400">
                <h2 class="text-lg font-semibold text-gray-50">PAROKI SANTO YOSEPH</h2>
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
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    (0280) 523896
                </p>
                <p class="flex items-center justify-center md:justify-start">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.555 4.707A1 1 0 013 4h14a1 1 0 01.445.707l-7 7a1 1 0 01-1.445 0l-7-7zM2 8V5a2 2 0 012-2h12a2 2 0 012 2v3a1 1 0 01-.445.707l-7 7a1 1 0 01-1.445 0l-7-7z" clip-rule="evenodd"></path></svg>
                    paroki.santosyoseph@gmail.com
                </p>
            </div>

            {{-- Jadwal Buka Sekretariat --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-50">Jadwal Buka Sekretariat</h4>
                <p class="mb-1">Senin - Jumat</p>
                <p class="text-sm text-gray-400 mb-3">08.00 - 15.00</p>
                <p class="mb-1">Sabtu - Minggu</p>
                <p class="text-sm text-gray-400">Tutup</p>
            </div>

            {{-- Peta Situs --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 text-gray-50">Peta Situs</h4>
                <ul class="text-gray-300">
                    <li class="mb-2"><a href="#" class="hover:text-white transition-colors duration-200">Beranda</a></li>
                    <li class="mb-2"><a href="#" class="hover:text-white transition-colors duration-200">Informasi</a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-200">Tentang Gereja</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 text-center text-gray-500 text-sm border-t border-gray-800 pt-6">
            &copy; Created by Cecilio 2025 Paroki Santo Yoseph Sidareja.
        </div>
    </footer>

</body>
</html>