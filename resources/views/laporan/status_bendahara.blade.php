<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Laporan Kolekte - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Kustom dari dashboard.blade.php */
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
            border-bottom: 1px solid #e2e8f0; /* Tambahkan garis tipis di bawah */
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

        /* Penyesuaian untuk tabel agar terlihat lebih modern */
        .table-responsive {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* border-radius: 0.75rem; */ /* HAPUS border-radius untuk sudut kotak */
            overflow: hidden; /* Ensure content is clipped */
            overflow-x: auto; /* Ini penting untuk scroll horizontal */
        }

        .modern-table {
            min-width: 700px; /* **PERUBAHAN: Atur lebar minimum lebih besar lagi untuk mobile** */
            width: 100%; /* Pastikan tabel selalu mencoba mengisi 100% dari parentnya */
            font-size: 0.875rem; /* text-sm untuk seluruh tabel */
        }

        .modern-table thead th {
            background-color: #e2e8f0; /* bg-gray-200 */
            color: #4a5568; /* text-gray-700 */
            font-weight: 600; /* semi-bold */
            text-transform: uppercase;
            letter-spacing: 0.05em; /* tracking-wider */
            border-bottom: 2px solid #cbd5e0; /* border-gray-300 */
            padding: 0.75rem 1rem; /* py-3 px-4, sedikit lebih besar dari py-2 px-4 sebelumnya */
            font-size: 0.75rem; /* text-xs untuk header tabel di mobile */
        }
        .modern-table tbody td {
            padding: 0.75rem 1rem; /* py-3 px-4, sedikit lebih besar dari py-2 px-4 sebelumnya */
            border-bottom: 1px solid #edf2f7; /* border-gray-200 */
            font-size: 0.75rem; /* text-xs untuk sel tabel di mobile */
        }
        .modern-table tbody tr:last-child td {
            border-bottom: none; /* No border for the last row */
        }
        .modern-table tbody tr:hover {
            background-color: #f7fafc; /* bg-gray-50 */
        }
        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.5rem; /* Padding lebih kecil lagi untuk badge */
            border-radius: 9999px; /* full rounded */
            font-size: 0.625rem; /* text-xs, lebih kecil dari text-sm, bahkan lebih kecil dari sebelumnya */
            font-weight: 600; /* font-semibold */
            line-height: 1;
            white-space: nowrap;
        }
        .status-pending {
            background-color: #fefcbf; /* yellow-100 */
            color: #92400e; /* yellow-700 */
        }
        .status-validated {
            background-color: #d1fae5; /* green-100 */
            color: #065f46; /* green-700 */
        }
        .status-rejected {
            background-color: #fee2e2; /* red-100 */
            color: #991b1b; /* red-700 */
        }

        /* Mobile-specific styles (max-width: 767px) */
        @media (max-width: 767px) {
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
            header .mobile-welcome {
                display: block;
                font-size: 0.75rem; /* Ukuran font mobile-welcome lebih kecil */
                text-align: right;
            }
            header .desktop-welcome {
                display: none;
            }
            #burger-btn {
                z-index: 22;
                margin-right: 0.5rem; /* Kurangi margin burger button */
                padding: 0.5rem; /* Kurangi padding burger button */
            }
            .main-content {
                padding-top: 0;
                padding-left: 0.75rem; /* DIKECILKAN: Tambahkan sedikit padding kiri dan kanan */
                padding-right: 0.75rem; /* DIKECILKAN: Tambahkan sedikit padding kiri dan kanan */
                margin-top:2rem;
            }

            /* Kartu yang membungkus tabel */
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 1rem !important; /* **PERUBAHAN: Padding card ditingkatkan untuk memberi ruang pada tabel** */
                width: 100%;
                box-sizing: border-box;
                border-radius: 0; /* **PERUBAHAN: Menjadikan sudut card kotak** */
            }

            /* Tabel responsif akan discroll */
            .table-responsive {
                width: 100%;
                box-sizing: border-box;
            }
            /* Sesuaikan ukuran font di dalam tabel untuk mobile */
            .modern-table thead th,
            .modern-table tbody td {
                font-size: 0.7rem; /* Lebih kecil lagi untuk sel dan header tabel */
                padding: 0.4rem 0.6rem; /* **PERUBAHAN: Padding sel tabel sedikit ditingkatkan** */
            }
            .status-badge {
                font-size: 0.55rem; /* Badge lebih kecil lagi */
                padding: 0.15rem 0.4rem;
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
                padding-top: 0 !important;
            }
            header {
                position: relative !important;
                padding: 1rem 1.5rem !important; /* Kembali ke padding desktop yang sedikit dikurangi dari default */
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                border-bottom: none !important;
            }
            header h1 {
                font-size: 1.75rem !important; /* Ukuran font h1 di desktop */
            }
            header .mobile-welcome {
                display: none !important;
            }
            header .desktop-welcome {
                display: flex !important;
            }
            #burger-btn {
                display: none !important; /* Sembunyikan burger button di desktop */
            }
            .main-content {
                padding: 2.5rem !important; /* Padding utama kembali ke desktop */
                width: auto !important;
            }
            .bg-white.p-8.rounded-xl.shadow-md.card-hover-effect {
                padding: 2rem !important; /* Padding card kembali ke desktop */
                width: auto !important;
                border-radius: 0.75rem !important; /* Kembali ke sudut melengkung di desktop */
            }
            .modern-table {
                min-width: auto; /* Reset min-width di desktop */
            }
            .modern-table thead th,
            .modern-table tbody td {
                font-size: 0.875rem !important; /* Kembali ke text-sm di desktop */
                padding: 0.75rem 1rem !important; /* Padding desktop */
            }
            .status-badge {
                font-size: 0.625rem !important; /* Kembali ke text-xs di desktop */
                padding: 0.25rem 0.6rem !important;
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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Status Validasi Laporan
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

    <div class="flex-grow p-6 md:p-10 main-content">
        <header class="bg-white rounded-xl shadow-lg flex items-center justify-between mb-8">
            <div class="flex items-center">
                <button id="burger-btn" class="md:hidden mr-4 p-2 focus:outline-none focus:bg-gray-200 rounded-md" onclick="toggleSidebar()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl md:text-3xl font-extrabold text-gray-800">Status Laporan Kolekte {{ $namaStasi }}</h1>
            </div>
        </header>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-3 py-2.5 rounded-lg relative mb-4 md:mb-6 shadow-md text-sm md:text-base" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2.5 rounded-lg relative mb-4 md:mb-6 shadow-md text-sm md:text-base" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 md:p-8 rounded-xl shadow-md card-hover-effect">
            <h1 class="font-semibold text-blue-800 mb-4 md:mb-6 border-b pb-2 md:pb-3 border-gray-200">Daftar Laporan Kolekte Anda</h1>

            @if ($laporanKolektes->isEmpty())
                <p class="text-gray-600 text-sm md:text-lg text-center py-4 md:py-8">Anda belum mengirim laporan kolekte untuk Stasi {{ $namaStasi }}.</p>
            @else
                <div class="table-responsive"> {{-- Pastikan overflow-x: auto ada di sini --}}
                    <table class="min-w-full bg-white modern-table">
                        <thead>
                            <tr>
                                <th class="text-left">Tanggal Kolekte</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-center">Status Ketua Stasi</th>
                                <th class="text-left">Catatan Revisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($laporanKolektes as $laporan)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $laporan->tanggal_kolekte->format('d M Y') }}</td>
                                    <td class="text-right">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($laporan->status_ketua_stasi == 'pending')
                                            <span class="status-badge status-pending">Pending</span>
                                        @elseif ($laporan->status_ketua_stasi == 'divalidasi')
                                            <span class="status-badge status-validated">Divalidasi</span>
                                        @else
                                            <span class="status-badge status-rejected">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        @if ($laporan->status_ketua_stasi == 'ditolak' && $laporan->catatan_revisi_ketua_stasi)
                                            <p class="text-red-600 italic">{{ $laporan->catatan_revisi_ketua_stasi }}</p>
                                        @else
                                            <span class="text-gray-500">-</span>
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

        // JavaScript untuk menghilangkan notifikasi sukses setelah 5 detik
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.transition = 'opacity 0.5s ease-out';
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.remove(); // Hapus elemen dari DOM setelah transisi
                    }, 500); // Sesuaikan dengan durasi transisi
                }, 5000); // 5000 milidetik = 5 detik
            }
        });
    </script>
</body>
</html>
