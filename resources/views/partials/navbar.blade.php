<nav class="bg-blue-900 p-4 text-white flex justify-between items-center relative z-10 shadow-md">
    {{-- Logo Paroki dan Nama Paroki --}}
    <div class="flex items-center navbar-brand">
        <a href="{{ route('landing') }}" class="flex items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Paroki" class="h-10 w-10 mr-3 rounded-full border border-white">
            <span class="text-xl md:text-2xl font-bold">PAROKI SANTO YOSEPH SIDAREJA</span>
        </a>
    </div>

    {{-- Bagian Kanan Navbar (Desktop) --}}
    <div class="hidden md:flex items-center space-x-6 navbar-desktop-nav">
        {{-- Tautan Beranda Baru untuk Desktop --}}
        <a href="{{ route('landing') }}" class="hover:text-yellow-400 transition-colors duration-200">Beranda</a>
        <a href="{{ route('profil-gereja') }}" class="hover:text-yellow-400 transition-colors duration-200">Profil Gereja</a>
        <a href="{{ route('kegiatan-agenda') }}" class="hover:text-yellow-400 transition-colors duration-200">Kegiatan/Agenda</a>
        <a href="{{ route('galeri') }}" class="hover:text-yellow-400 transition-colors duration-200">Galeri</a>
        <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button">
            LOGIN SIKOPAR
        </a>
    </div>

    {{-- Bagian Kanan Navbar (Mobile) --}}
    <div class="md:hidden flex items-center space-x-2 relative navbar-mobile-nav flex-grow justify-end">
        {{-- Dropdown Toggle (Panah ke Bawah) --}}
        <div class="mobile-dropdown-toggle" id="mobile-dropdown-toggle">
            <span class="text-white text-sm mr-1">Menu</span>
            <svg class="w-4 h-4 text-white transform transition-transform duration-300" id="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
        {{-- Tombol Login untuk Mobile --}}
        <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 shadow-lg login-button">
            LOGIN SIKOPAR
        </a>

        {{-- Dropdown Menu --}}
        <div id="mobile-dropdown-menu" class="dropdown-menu">
            {{-- Tautan Beranda Baru untuk Mobile --}}
            <a href="{{ route('landing') }}" class="dropdown-item">Beranda</a>
            <a href="{{ route('profil-gereja') }}" class="dropdown-item">Profil Gereja</a>
            <a href="{{ route('kegiatan-agenda') }}" class="dropdown-item">Kegiatan/Agenda</a>
            <a href="{{ route('galeri') }}" class="dropdown-item">Galeri</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('mobile-dropdown-toggle');
        const dropdownMenu = document.getElementById('mobile-dropdown-menu');
        const dropdownArrow = document.getElementById('dropdown-arrow');

        if (dropdownToggle && dropdownMenu && dropdownArrow) {
            dropdownToggle.addEventListener('click', function () {
                dropdownMenu.classList.toggle('active');
                dropdownArrow.classList.toggle('rotate-180');
            });

            document.addEventListener('click', function (event) {
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('active');
                    dropdownArrow.classList.remove('rotate-180');
                }
            });
        }
    });
</script>