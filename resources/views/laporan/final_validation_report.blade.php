<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kolekte Final - SIKOPAR</title>
    @vite('resources/css/app.css')
    <style>
       @media screen {
                .knowing-text {
                display: none !important;
                }}
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                font-size: 8pt;
                color: #000;
            }
            .knowing-text {
            display: block !important;
            }
            .no-print {
                display: none !important;
            }
            /* Menghilangkan sidebar saat mencetak */
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0 !important; /* Hapus margin sidebar */
                width: 100% !important;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px; /* Tambahkan sedikit jarak dari tombol cetak */
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
                color: #000; /* Pastikan teks terlihat di cetakan */
            }
            th {
                background-color: #f2f2f2;
            }
            /* Gaya khusus untuk baris total */
            .total-row td {
                font-weight: bold;
                background-color: #e0e0e0; /* Latar belakang abu-abu muda */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col md:flex-row min-h-screen">
        {{-- Sidebar (sesuaikan dengan role yang bisa mengakses ini, misalnya Sekretaris Paroki atau Romo Paroki) --}}
        <div class="bg-gray-800 text-gray-100 flex-none w-full md:w-64 pb-4 md:pb-0 sidebar no-print">
            <div class="p-4 text-center text-xl font-bold border-b border-gray-700">SIKOPAR</div>
            <nav>
                {{-- Contoh tautan untuk Sekretaris Paroki --}}
                @if (Auth::user()->hasRole('sekretaris-paroki'))
                    <a href="{{ route('dashboard.sekretaris-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Dashboard</a>
                    <a href="{{ route('sekretaris-paroki.laporan.final') }}" class="block py-2.5 px-4 rounded bg-gray-700 text-white">Laporan Kolekte Final</a>
                    {{-- Tambahkan tautan lain yang relevan untuk Sekretaris Paroki --}}
                @endif

                {{-- Contoh tautan untuk Romo Paroki --}}
                @if (Auth::user()->hasRole('romo-paroki'))
                    <a href="{{ route('dashboard.romo-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Dashboard</a>
                    <a href="{{ route('romo-paroki.laporan.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Validasi Laporan Kolekte</a>
                    <a href="{{ route('romo-paroki.laporan.final') }}" class="block py-2.5 px-4 rounded bg-gray-700 text-white">Laporan Kolekte Final</a>
                    {{-- Tambahkan tautan lain yang relevan untuk Romo Paroki --}}
                @endif

                {{-- Tautan Logout --}}
                 <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Logout</a>
                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow p-6 main-content">
            <header class="flex items-center justify-between pb-4 border-b border-gray-300 mb-6 no-print">
                <h1 class="text-3xl font-semibold text-gray-800">Laporan Kolekte Final</h1>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-700">Selamat datang, {{ Auth::user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Pesan Sukses/Error --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-['0.9rem'] font-semibold text-gray-800 mb-4">Daftar Laporan Kolekte yang Sudah Divalidasi Final</h3>

                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded no-print mb-4">
                    Cetak Laporan Ini
                </button>

                @if ($laporanKolektes->isEmpty())
                    <p class="text-gray-600">Belum ada laporan kolekte yang divalidasi secara final.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Tanggal Kolekte</th>
                                    <th class="py-2 px-4 border-b">Stasi</th>
                                    <th class="py-2 px-4 border-b">Nama Pengirim</th>
                                    <th class="py-2 px-4 border-b">Jumlah Kolekte</th>
                                    <th class="py-2 px-4 border-b">Status Ketua Stasi</th>
                                    <th class="py-2 px-4 border-b">Status Bendahara Paroki</th>
                                    <th class="py-2 px-4 border-b">Status Romo Paroki</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanKolektes as $laporan)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($laporan->tanggal_kolekte)->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">{{ $laporan->stasi->nama ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $laporan->nama_pengirim }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($laporan->jumlah_kolekte, 2, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                                @if($laporan->status_ketua_stasi === 'divalidasi') bg-green-200 text-green-800
                                                @elseif($laporan->status_ketua_stasi === 'ditolak') bg-red-200 text-red-800
                                                @else bg-gray-200 text-gray-800 @endif">
                                                {{ ucfirst($laporan->status_ketua_stasi) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                                @if($laporan->status_bendahara_paroki === 'divalidasi') bg-green-200 text-green-800
                                                @elseif($laporan->status_bendahara_paroki === 'ditolak') bg-red-200 text-red-800
                                                @else bg-gray-200 text-gray-800 @endif">
                                                {{ ucfirst($laporan->status_bendahara_paroki) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                                @if($laporan->status_romo_paroki === 'divalidasi') bg-green-200 text-green-800
                                                @elseif($laporan->status_romo_paroki === 'ditolak') bg-red-200 text-red-800
                                                @else bg-gray-200 text-gray-800 @endif">
                                                {{ ucfirst($laporan->status_romo_paroki) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- TAMBAHAN: FOOTER TABEL UNTUK TOTAL --}}
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="3" class="py-2 px-4 text-right">Total Keseluruhan Kolekte:</td>
                                    <td class="py-2 px-4">Rp {{ number_format($totalKolekte, 2, ',', '.') }}</td>
                                    <td colspan="3" class="py-2 px-4"></td> {{-- Kosongkan sisa kolom --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>