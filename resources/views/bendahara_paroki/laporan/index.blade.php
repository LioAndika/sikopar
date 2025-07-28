<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kolekte Divalidasi - Bendahara Paroki</title>
    @vite('resources/css/app.css')
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
                padding-top: 5rem; /* Increased from 4rem for more space */
            }
             header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10; /* Ensure header is above main content */
                background-color: white; /* Ensure header has a background */
                padding: 0.4rem 0.8rem; /* DIKECILKAN: Adjusted header padding for mobile to be smaller */
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0; /* Optional: add a border to header */
                margin-bottom: 1rem; /* Memberi jarak bawah header di mobile */
            }
            header h1 {
                font-size: 0.8rem; /* DIKECILKAN: Further reduced font size for mobile header */
                font-weight: bold;
                color: #374151; /* Match general text color */
            }
            header h1 svg {
                display: none; /* HIDE SVG ICON ON MOBILE */
            }
            /* Show welcome message on mobile but with smaller text */
            header .mobile-welcome {
                display: none; /* Show on mobile */
                font-size: 0.875rem; /* text-sm */
                text-align: right;
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
                display: none !important; /* Show desktop welcome on desktop */
                align-items: center; /* Vertically align items in desktop welcome */
            }
            header .desktop-welcome span {
                font-size: 0.95rem; /* Slightly smaller welcome text for desktop */
            }
        }

        /* Gaya baru untuk teks tabel */
        .table-text-style {
            font-size: 0.6rem; /* Slightly larger than text-sm (0.875rem) */
            color: #334155; /* slate-700, warna teks umum yang lebih gelap */
        }
        .table-header-text-style {
            font-size: 0.8rem; /* Lebih kecil dari body teks */
            color: #4A5568; /* gray-700 */
            font-weight: 600; /* semi-bold */
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col md:flex-row">
    <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
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
            <a href="{{ route('bendahara-paroki.laporan.history.bendahara-paroki') }}" class="sidebar-item {{ Request::routeIs('bendahara-paroki.laporan.history.bendahara-paroki') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> {{-- Ikon untuk Riwayat --}}
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
                <h1 class="text-4xl font-extrabold text-gray-800">Laporan Kolekte yang Menunggu Validasi Bendahara Paroki</h1>
            </div>
            <div class="desktop-welcome flex items-center space-x-4">
                <span class="text-gray-700 text-lg">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
            </div>
            <div class="mobile-welcome md:hidden">
                <span class="text-gray-700 text-sm">Selamat datang, <span class="font-bold text-blue-700">{{ Auth::user()->name }}!</span></span>
            </div>
        </header>

        <div class="bg-white p-8 rounded-xl shadow-lg card-hover-effect">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-md" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-md" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

           <h2 class="text-['1rem'] font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200 flex items-center">
    <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" clip-rule="evenodd"></path></svg>
    Daftar Laporan Kolekte yang Menunggu Validasi Anda
</h2>

            @if ($laporanKolektes->isEmpty())
                <p class="text-gray-600 text-center py-4">Tidak ada laporan kolekte yang menunggu validasi dari Anda.</p>
            @else
                <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                    <table class="min-w-full bg-white ">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left table-header-text-style">Tanggal Kolekte</th>
                                <th class="py-3 px-6 text-left table-header-text-style">Asal Stasi</th>
                                <th class="py-3 px-6 text-left table-header-text-style">Jumlah</th>
                                <th class="py-3 px-6 text-center table-header-text-style">Status Ketua Stasi</th>
                                <th class="py-3 px-6 text-center table-header-text-style">Status Bendahara Paroki</th>
                                <th class="py-3 px-6 text-center table-header-text-style ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light divide-y divide-gray-200">
                            @foreach ($laporanKolektes as $laporan)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 whitespace-nowrap text-left pl-9">{{ $laporan->tanggal_kolekte->format('d M Y') }}</td>
                                    <td class="py-3 px-6 text-left pl-4">{{ $laporan->stasi->nama ?? 'Stasi Tidak Dikenal' }}</td>
                                    <td class="py-3 px-6 text-left ">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($laporan->status_ketua_stasi == 'divalidasi')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full text-xs">Divalidasi</span>
                                        @elseif ($laporan->status_ketua_stasi == 'ditolak')
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full text-xs">Ditolak</span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full text-xs">Pending</span>
                                        @endif
                                    </td>
                                    {{-- Menampilkan Status Bendahara Paroki --}}
                                    <td class="py-3 px-6 text-center">
                                        @if ($laporan->status_bendahara_paroki == 'divalidasi')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full text-xs">Divalidasi</span>
                                        @elseif ($laporan->status_bendahara_paroki == 'ditolak')
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full text-xs">Ditolak</span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full text-xs">Pending</span>
                                        @endif
                                    </td>
                                    <td class="py-3   text-center">
                                        @if ($laporan->status_bendahara_paroki == 'pending')
                                            <div class="flex items-center justify-center space-x-2 ">
                                                <form action="{{ route('bendahara-paroki.laporan.validasi', $laporan->id) }}" method="POST" onsubmit="return confirmValidation()">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-300 shadow-md">Validasi</button>
                                                </form>
                                                <button onclick="showRejectModal({{ $laporan->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-300 shadow-md">Tolak</button>
                                            </div>
                                        @else
                                            <span class="text-gray-500 text-xs table-text-style">Sudah Diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

  <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white animate-fade-in-up">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Tolak Laporan Kolekte</h3>
            <form id="rejectForm" method="POST" onsubmit="return validateRejectForm()">
                @csrf
                <textarea name="catatan_revisi_bendahara_paroki" id="catatan_revisi_bendahara_paroki" rows="4" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-2" placeholder="Masukkan catatan penolakan"></textarea>
                <p id="catatanError" class="text-red-500 text-xs italic mb-4 hidden">Catatan penolakan tidak boleh kosong dan minimal 10 karakter.</p>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="hideRejectModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">Batal</button>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Tolak</button>
                </div>
            </form>
        </div>
    </div>

<script>
        let currentLaporanId = null;
        function showRejectModal(laporanId) {
            currentLaporanId = laporanId;
            const form = document.getElementById('rejectForm');
            // Pastikan Anda menggunakan rute yang benar untuk penolakan Bendahara Paroki
            form.action = `/bendahara-paroki/laporan/${laporanId}/tolak`;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('catatanError').classList.add('hidden'); // Sembunyikan pesan error sebelumnya
            document.body.classList.add('overflow-hidden'); // Prevent scrolling behind modal
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectForm').reset();
            document.getElementById('catatanError').classList.add('hidden'); // Sembunyikan pesan error
            currentLaporanId = null;
            document.body.classList.remove('overflow-hidden'); // Restore scrolling
        }

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

        // Function to show alert on validation button click
        function confirmValidation() {
            return confirm("Apakah Anda yakin ingin memvalidasi laporan ini?");
        }

        // Function to validate the reject form
        function validateRejectForm() {
            const catatanInput = document.getElementById('catatan_revisi_bendahara_paroki');
            const catatanError = document.getElementById('catatanError');
            const catatanValue = catatanInput.value.trim();

            // Atur ketentuan minimal karakter di sini (misal: 10 karakter)
            const minLength = 10; 

            if (catatanValue === '' || catatanValue.length < minLength) {
                catatanError.textContent = `Catatan penolakan tidak boleh kosong dan minimal ${minLength} karakter.`;
                catatanError.classList.remove('hidden'); // Tampilkan pesan error
                return false; // Mencegah pengiriman formulir
            } else {
                catatanError.classList.add('hidden'); // Sembunyikan pesan error
                return true; // Izinkan pengiriman formulir
            }
        }
    </script>
</body>
</html>