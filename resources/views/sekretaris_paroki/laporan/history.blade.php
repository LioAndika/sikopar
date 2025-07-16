<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Final - SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Your existing styles */
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">
    {{-- Sidebar (if you include it here) --}}

    <div class="flex-grow p-6 md:p-10">
        <header class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Riwayat Laporan Final</h1>
        </header>

        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Laporan Kolekte Sebelumnya</h2>

            {{-- SEARCH FORM ADDED HERE --}}
            <form action="{{ route('laporan.history') }}" method="GET" class="mb-6 no-print">
                <div class="flex items-center">
                    <input type="text" name="search" placeholder="Cari laporan..."
                           class="flex-grow p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ request('search') }}">
                    <button type="submit" class="ml-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('laporan.history') }}" class="ml-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
            {{-- END SEARCH FORM --}}

            @if ($historicalReports->isEmpty()) {{-- Changed to isEmpty() for clarity --}}
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Tidak ada data</p>
                    <p>Tidak ada riwayat laporan final yang tersedia.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kolekte</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kolekte</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diperbarui Pada</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($historicalReports as $report)
                                <tr>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->judul ?? 'Tidak Ada Judul' }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">{{ \Carbon\Carbon::parse($report->tanggal_kolekte)->format('d M Y') }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($report->jumlah_kolekte, 2, ',', '.') }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($report->updated_at)->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-8">
                <a href="{{ route('dashboard.sekretaris-paroki') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>