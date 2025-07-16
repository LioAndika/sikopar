@extends('layouts.app') {{-- Sesuaikan layout Anda, mungkin 'layouts.ketua_stasi' atau 'layouts.dashboard' --}}

@section('content')
<div class="container mx-auto p-6 md:p-10">
    <header class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">Riwayat Laporan Kolekte</h1>
    </header>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-2xl font-semibold text-gray-800 mb-5 border-b pb-3 border-gray-200">
            Daftar Laporan Kolekte Final Stasi {{ Auth::user()->stasi->nama_stasi ?? 'Anda' }}
        </h3>

        @if ($riwayatLaporan->isEmpty())
            <p class="text-gray-600 text-center py-4">Belum ada riwayat laporan kolekte final untuk stasi Anda.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-3 px-4 text-left rounded-tl-lg">Tanggal Laporan</th>
                            <th class="py-3 px-4 text-left">Jumlah (Rp)</th>
                            <th class="py-3 px-4 text-left">Validator</th>
                            <th class="py-3 px-4 text-left">Tanggal Validasi</th>
                            <th class="py-3 px-4 text-left rounded-tr-lg">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatLaporan as $laporan)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y') }}</td>
                                <td class="py-3 px-4">Rp {{ number_format($laporan->jumlah, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $laporan->validator->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4">{{ $laporan->tanggal_validasi ? \Carbon\Carbon::parse($laporan->tanggal_validasi)->translatedFormat('d F Y H:i') : 'Belum divalidasi' }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($laporan->status == 'disetujui') bg-green-200 text-green-800
                                        @elseif($laporan->status == 'selesai') bg-blue-200 text-blue-800
                                        @else bg-gray-200 text-gray-800
                                        @endif">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $riwayatLaporan->links() }} {{-- Menampilkan link pagination --}}
            </div>
        @endif
    </div>
</div>
@endsection