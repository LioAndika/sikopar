<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Paroki Santo Yoseph Sidareja</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Sesuaikan ukuran minmax */
            gap: 1.5rem;
        }
        .gallery-item img {
            width: 100%;
            height: 200px; /* Tinggi tetap untuk gambar galeri */
            object-fit: cover; /* Memastikan gambar memenuhi ruang tanpa terdistorsi */
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .gallery-item img:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        .gallery-item p {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            color: #4A5568;
            text-align: center;
        }

        /* Gaya untuk dropdown menu mobile (dari landing page) */
        .dropdown-menu {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            top: 100%; /* Tempatkan di bawah toggle */
            right: 0; /* Sesuaikan posisi sesuai kebutuhan, misal 'left: 0;' atau 'right: 0;' */
            background-color: rgba(30, 58, 138, 0.9); /* Darker blue, slightly transparent */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            flex-direction: column; /* Atur item agar vertikal */
            border-radius: 0.5rem; /* Tambahkan sedikit border-radius */
            overflow: hidden; /* Pastikan konten tidak meluber */
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out; /* Smooth transition */
            max-height: 0; /* Initial state: hidden */
            opacity: 0;
            padding: 0; /* Remove default padding to control height via max-height */
        }

        .dropdown-menu.active {
            display: flex; /* Tampilkan saat active */
            max-height: 190px; /* Cukup tinggi untuk menampung semua item (ditambah dari 150px) */
            opacity: 1;
            padding: 0.4rem 0; /* Mengurangi padding vertikal saat aktif */
        }

        .dropdown-item {
            color: white; /* Warna teks item */
            padding: 0.4rem 1rem; /* Mengurangi padding vertikal pada setiap item */
            text-decoration: none;
            display: block; /* Buat setiap item menjadi blok */
            text-align: left; /* Ratakan teks ke kiri */
            transition: background-color 0.3s ease, color 0.3s ease; /* Transisi halus saat hover */
            font-size: 0.9rem; /* Mengurangi ukuran font */
            line-height: 1.2; /* Menyesuaikan tinggi baris */
            outline: none; /* Menghilangkan outline bawaan browser */
        }

        .dropdown-item:hover, .dropdown-item:focus {
            background-color: rgba(49, 130, 206, 0.9); /* Warna latar belakang saat hover, sesuaikan */
            color: #fbd38d; /* Warna teks saat hover */
        }

        /* Sedikit penyesuaian untuk toggle agar ada ruang di sebelah tombol login */
        .navbar-mobile-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Memastikan elemen tetap di kanan */
            flex-grow: 1; /* Biarkan mengambil ruang yang tersedia */
        }

        .mobile-dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px; /* Tambahkan padding agar lebih mudah diklik */
            background-color: rgba(255, 255, 255, 0.1); /* Sedikit latar belakang agar terlihat */
            border-radius: 9999px; /* Bentuk pil */
            margin-right: 1rem; /* Beri jarak dengan tombol LOGIN SIKOPAR */
            outline: none; /* Remove default outline */
            transition: all 0.2s ease-in-out;
        }

        .mobile-dropdown-toggle:focus {
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5), 0 0 0 4px rgba(252, 211, 77, 0.75); /* yellow-400, opacity-75 */
        }

        /* Gaya untuk panah dropdown */
        #dropdown-arrow {
            transition: transform 0.3s ease;
        }

        #dropdown-arrow.rotate-180 {
            transform: rotate(180deg);
        }

        /* Responsive Adjustments dari Landing Page */
        @media (max-width: 767px) { /* Adjustments for screens smaller than 'md' breakpoint */
            nav {
                padding: 0.75rem 1rem; /* Adjust padding for mobile navbar */
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
                margin-right: 0.5rem; /* Reduced space between dropdown toggle and login button */
                white-space: nowrap; /* Prevent text and icon from wrapping */
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

        @media (min-width: 768px) {
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
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">
    {{-- Navbar Sederhana dengan Logo dan Tombol Login --}}
    <nav class="bg-blue-900 p-4 text-white flex justify-between items-center relative z-10 shadow-md">
        {{-- Logo Paroki dan Nama Paroki --}}
        <div class="flex items-center navbar-brand">
            <a href="{{ route('landing') }}" class="flex items-center" aria-label="Beranda Paroki Santo Yoseph Sidareja">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-10 w-10 mr-3 rounded-full border border-white">
                <span class="text-xl md:text-2xl font-bold">PAROKI SANTO YOSEPH SIDAREJA</span>
            </a>
        </div>

        {{-- Bagian Kanan Navbar (Desktop) --}}
        <div class="hidden md:flex items-center space-x-6 navbar-desktop-nav">
            <a href="{{ route('landing') }}" class="
                {{ request()->routeIs('landing') ? 'text-yellow-300 underline' : 'text-white' }}
                hover:text-yellow-300 transition-colors duration-200 focus:text-yellow-300 focus:outline-none
            ">Beranda</a>
            <a href="{{ route('profil-gereja') }}" class="
                {{ request()->routeIs('profil-gereja') ? 'text-yellow-300 underline' : 'text-white' }}
                hover:text-yellow-300 transition-colors duration-200 focus:text-yellow-300 focus:outline-none
            ">Profil Gereja</a>
            <a href="{{ route('kegiatan-agenda') }}" class="
                {{ request()->routeIs('kegiatan-agenda') ? 'text-yellow-300 underline' : 'text-white' }}
                hover:text-yellow-300 transition-colors duration-200 focus:text-yellow-300 focus:outline-none
            ">Kegiatan/Agenda</a>
            <a href="{{ route('galeri') }}" class="
                {{ request()->routeIs('galeri') ? 'text-yellow-300 underline' : 'text-white' }}
                hover:text-yellow-300 transition-colors duration-200 focus:text-yellow-300 focus:outline-none
            ">Galeri</a>
            {{-- Link Informasi dipindahkan ke kanan Galeri --}}
            <a href="{{ route('informasi') }}" class="
                {{ request()->routeIs('informasi') ? 'text-yellow-300 underline' : 'text-white' }}
                hover:text-yellow-300 transition-colors duration-200 focus:text-yellow-300 focus:outline-none
            ">Informasi</a>
            <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-blue-900">
                LOGIN SIKOPAR
            </a>
        </div>

        {{-- Bagian Kanan Navbar (Mobile) --}}
        <div class="md:hidden flex items-center space-x-2 relative navbar-mobile-nav flex-grow justify-end">
            {{-- Dropdown Toggle (Panah ke Bawah) --}}
            <div class="mobile-dropdown-toggle" id="mobile-dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" tabindex="0">
                <span class="text-white text-sm mr-1">Menu</span>
                <svg class="w-4 h-4 text-white transform transition-transform duration-300" id="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            {{-- Tombol Login untuk Mobile --}}
            <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-blue-900">
                LOGIN SIKOPAR
            </a>

            {{-- Dropdown Menu --}}
            <div id="mobile-dropdown-menu" class="dropdown-menu" role="menu">
                <a href="{{ route('landing') }}" class="
                    dropdown-item
                    {{ request()->routeIs('landing') ? 'text-yellow-300 underline bg-blue-700' : '' }}
                " role="menuitem">Beranda</a>
                <a href="{{ route('profil-gereja') }}" class="
                    dropdown-item
                    {{ request()->routeIs('profil-gereja') ? 'text-yellow-300 underline bg-blue-700' : '' }}
                " role="menuitem">Profil Gereja</a>
                <a href="{{ route('kegiatan-agenda') }}" class="
                    dropdown-item
                    {{ request()->routeIs('kegiatan-agenda') ? 'text-yellow-300 underline bg-blue-700' : '' }}
                " role="menuitem">Kegiatan/Agenda</a>
                <a href="{{ route('galeri') }}" class="
                    dropdown-item
                    {{ request()->routeIs('galeri') ? 'text-yellow-300 underline bg-blue-700' : '' }}
                " role="menuitem">Galeri</a>
                {{-- Link Informasi dipindahkan ke kanan Galeri untuk mobile --}}
                <a href="{{ route('informasi') }}" class="
                    dropdown-item
                    {{ request()->routeIs('informasi') ? 'text-yellow-300 underline bg-blue-700' : '' }}
                " role="menuitem">Informasi</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-8 bg-white shadow-lg rounded-lg my-8">
        <h1 class="text-3xl font-bold text-blue-800 mb-8 text-center">Galeri Foto Paroki</h1>

        <section class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/paskah.jpg') }}" alt="Misa Vigili Paskah">
                <p>Misa Vigili Paskah</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/komunipertama.jpg') }}" alt="Penerimaan Komuni Pertama">
                <p>Penerimaan Komuni Pertama</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/minggupalma.jpg') }}" alt="Perayaan Misa Minggu Palma">
                <p>Perayaan Misa Minggu Palma</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/natal2024.jpg') }}" alt="Perayaan Natal 2024">
                <p>Perayaan Natal 2024</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/ziarahwonosobo.jpg') }}" alt="Ziarah Rohani di Goa Maria Tangroanggro Wonosobo">
                <p>Ziarah Rohani di Goa Maria Tangroanggro Wonosobo</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/ziarahomk.jpg') }}" alt="Ziarah Yubeleum Remaja dan OMK Keuskupan Purwokerto">
                <p>Ziarah Yubeleum Remaja dan OMK Keuskupan Purwokerto</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/hutpdpkk.jpg') }}" alt="Doa bersama Bapa Uskup Mgr. Cristophorus Tri Harsono dalam rangka HUT PDPKK Sidareja Ke-7">
                <p>Doa bersama Bapa Uskup Mgr. Cristophorus Tri Harsono dalam rangka HUT PDPKK Sidareja Ke-7</p>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/pelantikan.jpg') }}" alt="Pelantikan Pastor Kepala Paroki Santo Yoseph Sidareja">
                <p>Pelantikan Pastor Kepala Paroki Santo Yoseph Sidareja</p>
            </div>
        </section>

    </main>

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
                    {{-- Link Informasi di Footer juga dipindahkan --}}
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