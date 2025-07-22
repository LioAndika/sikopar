<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Hapus metode landing() karena sudah ditangani di web.php
    /*
    public function landing()
    {
        return view('landing');
    }
    */

    /**
     * Menampilkan halaman profil gereja.
     */
    public function profilGereja()
    {
        return view('pages.profil-gereja');
    }

    /**
     * Menampilkan halaman kegiatan dan agenda.
     */
    public function kegiatanAgenda()
    {
        return view('pages.kegiatan-agenda');
    }

    /**
     * Menampilkan halaman galeri.
     */
    public function galeri()
    {
        return view('pages.galeri');
    }

    /**
     * Menampilkan halaman informasi (jadwal misa & pengumuman).
     */
    public function informasi()
    {
        return view('pages.informasi');
    }
}