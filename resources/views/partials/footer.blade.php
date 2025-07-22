<footer class="bg-blue-950 text-gray-200 py-10">
    <div class="container mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-8 footer-grid">
        {{-- Logo dan Nama Paroki di Footer --}}
        <div class="flex flex-col items-center text-center footer-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-20 w-20 mb-4 rounded-full border-2 border-gray-400">
            <h2 class="text-lg font-semibold text-gray-50">PAROKI SANTO YOSEPH</h2>
            <h2 class="text-lg font-semibold text-gray-50">SIDAREJA</h2>
        </div>

        {{-- Kontak Kami --}}
        <div>
            <h4 class="text-lg font-semibold mb-4 text-gray-50">Kontak Kami</h4>
            <p class="flex items-center mb-2 justify-center md:justify-start">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 9a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Jl Ranggaesera No. 596, Sidareja - Cilacap 53213, Jawa Tengah
            </p>
            <p class="flex items-center mb-2 justify-center md:justify-start">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                (0280) 523896
            </p>
            <p class="flex items-center justify-center md:justify-start">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.555 4.707A1 1 0 013 4h14a1 1 0 01.445.707l-7 7a1 1 0 01-1.445 0l-7-7zM2 8V5a2 2 0 012-2h12a2 2 0 012 2v3a1 1 0 01-.445.707l-7 7a1 1 0 01-1.445 0l-7-7z" clip-rule="evenodd"></path></svg>
                paroki.santosyoseph@gmail.com
            </p>
        </div>

        {{-- Jadwal Buka Sekretariat --}}
        <div>
            <h4 class="text-lg font-semibold mb-4 text-gray-50">Jadwal Buka Sekretariat</h4>
            <p class="mb-1">Senin - Jumat</p>
            <p class="text-sm text-gray-400 mb-3">08.00 - 15.00</p>
            <p class="mb-1">Sabtu - Minggu</p>
            <p class="text-sm text-gray-400">Tutup</p>
        </div>

        {{-- Peta Situs --}}
        <div>
            <h4 class="text-lg font-semibold mb-4 text-gray-50">Peta Situs</h4>
            <ul class="text-gray-300">
                <li class="mb-2"><a href="{{ route('profil-gereja') }}" class="hover:text-white transition-colors duration-200">Profil Gereja</a></li>
                <li class="mb-2"><a href="{{ route('kegiatan-agenda') }}" class="hover:text-white transition-colors duration-200">Kegiatan/Agenda</a></li>
                <li class="mb-2"><a href="{{ route('galeri') }}" class="hover:text-white transition-colors duration-200">Galeri</a></li>
            </ul>
        </div>
    </div>
    <div class="mt-8 text-center text-gray-500 text-sm border-t border-gray-800 pt-6">
        &copy; Created by Stefanus Cecilio 2025 Paroki Santo Yoseph Sidareja.
    </div>
</footer>