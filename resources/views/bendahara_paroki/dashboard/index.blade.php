<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bendahara Paroki - SIKOPAR</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col md:flex-row min-h-screen">
        {{-- Sidebar Bendahara Paroki --}}
    <div class="bg-gray-800 text-gray-100 flex-none w-full md:w-64 pb-4 md:pb-0">
    <div class="p-4 text-center text-xl font-bold border-b border-gray-700">SIKOPAR</div>
    <nav>
        <a href="{{ route('dashboard.bendahara-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('dashboard.bendahara-paroki') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Dashboard
        </a>
        <a href="{{ route('bendahara-paroki.laporan.index') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('bendahara-paroki.laporan.index') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Validasi Laporan Ketua Stasi
        </a>
        <a href="{{ route('bendahara-paroki.laporan.menunggu-romo') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('bendahara-paroki.laporan.menunggu-romo') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Laporan Menunggu Romo Paroki
        </a>
        <a href="{{ route('bendahara-paroki.laporan.final') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('bendahara-paroki.laporan.final') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Laporan Kolekte Final
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Logout</a>
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </nav>
</div>

        {{-- Main Content --}}
        <div class="flex-grow p-6">
            <header class="flex items-center justify-between pb-4 border-b border-gray-300 mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Dashboard Bendahara Paroki</h1>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-700">Selamat datang, {{ Auth::user()->name }}!</span>
                  
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Ringkasan Laporan untuk Bendahara Paroki --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Ringkasan Laporan</h3>
                    <p class="text-gray-700">Laporan menunggu validasi Anda: <strong class="text-blue-600">{{ \App\Models\LaporanKolekte::where('status_ketua_stasi', 'divalidasi')->where('status_bendahara_paroki', 'pending')->count() }}</strong></p>
                    <p class="text-gray-700">Laporan menunggu Romo Paroki: <strong class="text-yellow-600">{{ \App\Models\LaporanKolekte::where('status_bendahara_paroki', 'divalidasi')->where('status_romo_paroki', 'pending')->count() }}</strong></p>
                    {{-- Anda bisa menambahkan lebih banyak ringkasan di sini --}}
                </div>

                {{-- Statistik Kolekte --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Statistik Kolekte Bulanan</h3>
                    <p class="text-gray-700">Grafik kolekte bulanan akan ditampilkan di sini (misalnya, total kolekte bulan ini, bulan lalu).</p>
                    {{-- Anda bisa menambahkan chart JS di sini nantinya --}}
                </div>

                {{-- Papan Pengumuman (jika relevan untuk Bendahara Paroki) --}}
                <div class="bg-white p-6 rounded-lg shadow-md col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Papan Pengumuman Kolekte</h3>
                    <div class="prose max-w-none">
                        @php
                            $announcement = \App\Models\Pengumuman::latest()->first(); // Asumsi ada model Pengumuman
                        @endphp

                        @if ($announcement)
                            <p class="text-gray-700 whitespace-pre-line">{{ $announcement->content }}</p>
                            <p class="text-sm text-gray-500 mt-2">Dibuat pada: {{ $announcement->created_at->format('d M Y H:i') }}</p>
                        @else
                            <p class="text-gray-500">Belum ada pengumuman.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>