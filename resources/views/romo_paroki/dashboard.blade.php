<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Romo Paroki - SIKOPAR</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col md:flex-row min-h-screen">
        {{-- Sidebar --}}
       <div class="bg-gray-800 text-gray-100 flex-none w-full md:w-64 pb-4 md:pb-0">
            <div class="p-4 text-center text-xl font-bold border-b border-gray-700">SIKOPAR</div>
            <nav>
                <a href="{{ route('dashboard.romo-paroki') }}" class="block py-2.5 px-4 rounded bg-gray-700 text-white">Dashboard</a>
                <a href="{{ route('romo-paroki.laporan.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Validasi Laporan Kolekte</a>
                <a href="{{ route('romo-paroki.laporan.final') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Laporan Kolekte Final</a>
                {{-- Tautan Logout DITAMBAHKAN DI SINI --}}
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Logout</a>
                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow p-6">
            <header class="flex items-center justify-between pb-4 border-b border-gray-300 mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Dashboard Romo Paroki</h1>
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

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Laporan Kolekte</h2>
                <p class="text-gray-600 mb-4">Lihat laporan kolekte yang menunggu validasi akhir Anda.</p>
                <a href="{{ route('romo-paroki.laporan.index') }}" class="text-blue-500 hover:underline">Validasi Laporan Kolekte</a>
            </div>
        </div>
    </div>
</body>
</html>