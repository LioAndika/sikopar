@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Laporan Kolekte Final</h2>

    {{-- Form Pencarian dan Filter --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <form action="{{ route('laporan.history') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Laporan (Pengirim/Stasi)</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
             <div>
                <label for="stasi_id" class="block text-sm font-medium text-gray-700">Filter Stasi</label>
                <select name="stasi_id" id="stasi_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Stasi</option>
                    @foreach($stasiOptions as $stasi)
                        <option value="{{ $stasi->id }}" {{ request('stasi_id') == $stasi->id ? 'selected' : '' }}>
                            {{ $stasi->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-4 flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Terapkan Filter
                </button>
                <a href="{{ route('laporan.history') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
                    Reset Filter
                </a>
            </div>
        </form>
    </div>

    {{-- Tabel Laporan --}}
    @if ($laporanKolektes->isEmpty())
        <p class="text-center text-gray-600 mt-8">Tidak ada laporan final yang ditemukan dengan kriteria yang dipilih.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Kolekte
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pengirim
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stasi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Kolekte
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Ketua Stasi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Bendahara Paroki
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Romo Paroki
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($laporanKolektes as $laporan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_kolekte)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $laporan->nama_pengirim }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $laporan->stasi->nama ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($laporan->jumlah_kolekte, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($laporan->status_ketua_stasi == 'divalidasi') bg-green-100 text-green-800
                                    @elseif($laporan->status_ketua_stasi == 'ditolak') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($laporan->status_ketua_stasi) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($laporan->status_bendahara_paroki == 'divalidasi') bg-green-100 text-green-800
                                    @elseif($laporan->status_bendahara_paroki == 'ditolak') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($laporan->status_bendahara_paroki) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($laporan->status_romo_paroki == 'divalidasi') bg-green-100 text-green-800
                                    @elseif($laporan->status_romo_paroki == 'ditolak') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($laporan->status_romo_paroki) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total Kolekte --}}
        <div class="mt-6 p-4 bg-gray-100 rounded-lg shadow-md text-right">
            <p class="text-lg font-semibold text-gray-800">Total Kolekte Keseluruhan: <span class="text-green-600">Rp {{ number_format($totalKolekte, 0, ',', '.') }}</span></p>
        </div>

        {{-- Paginasi --}}
        <div class="mt-6">
            {{ $laporanKolektes->links() }}
        </div>
    @endif
</div>
@endsection