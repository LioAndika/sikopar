<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stasi;
use App\Models\Pengumuman;
use App\Models\LaporanKolekte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SuperAdminController extends Controller // Keep this name
{
    public function superAdminDashboard() // Changed method name
    {
        $totalUsers = User::count();
        $totalStasi = Stasi::count();
        $announcement = Pengumuman::latest()->first();

        $monthlyCollections = LaporanKolekte::select(
                DB::raw('DATE_FORMAT(tanggal_kolekte, "%Y-%m") as month'),
                DB::raw('SUM(jumlah_kolekte) as total_jumlah')
            )
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $chartLabels = [];
        $chartData = [];

        foreach ($monthlyCollections as $collection) {
            $date = \DateTime::createFromFormat('Y-m', $collection->month);
            $chartLabels[] = $date->format('M Y');
            $chartData[] = $collection->total_jumlah;
        }

        return view('dashboard.super_admin', compact('totalUsers', 'totalStasi', 'announcement', 'chartLabels', 'chartData')); // Changed view name
    }
}