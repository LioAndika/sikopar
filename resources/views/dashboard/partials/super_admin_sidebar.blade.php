{{-- resources/views/dashboard/partials/super_admin_sidebar.blade.php --}}
<div class="bg-gray-800 text-gray-100 flex-none w-full md:w-64 pb-4 md:pb-0">
    <div class="p-4 text-center text-xl font-bold border-b border-gray-700">SIKOPAR</div>
    <nav>
        {{-- KOREKSI DI SINI: Ubah 'super-admin.dashboard' menjadi 'dashboard.super-admin' --}}
        <a href="{{ route('dashboard.super-admin') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('dashboard.super-admin') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Dashboard
        </a>

        <div class="mt-4 text-xs uppercase text-gray-400 px-4">Admin Features</div>
        <a href="{{ route('super-admin.users.index') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('super-admin.users.index') || Request::routeIs('super-admin.users.create') || Request::routeIs('super-admin.users.edit') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Kelola User
        </a>

        {{-- Link untuk Kelola Stasi --}}
        <a href="{{ route('super-admin.stasi.index') }}" class="block py-2.5 px-4 rounded transition duration-200
            {{ Request::routeIs('super-admin.stasi.index') || Request::routeIs('super-admin.stasi.create') || Request::routeIs('super-admin.stasi.edit') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            Kelola Stasi
        </a>

         <div class="mt-4 text-xs uppercase text-gray-400 px-4">Akses Dashboard Peran Lain</div>
                <a href="{{ route('dashboard.bendahara-stasi') }}" class="block py-2.5 px-4 rounded transition duration-200
                    {{ Request::routeIs('dashboard.bendahara-stasi') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    Dashboard Bendahara Stasi
                </a>
                <a href="{{ route('dashboard.ketua-stasi') }}" class="block py-2.5 px-4 rounded transition duration-200
                    {{ Request::routeIs('dashboard.ketua-stasi') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    Dashboard Ketua Stasi
                </a>
                <a href="{{ route('dashboard.bendahara-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200
                    {{ Request::routeIs('dashboard.bendahara-paroki') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    Dashboard Bendahara Paroki
                </a>
                <a href="{{ route('dashboard.sekretaris-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200
                    {{ Request::routeIs('dashboard.sekretaris-paroki') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    Dashboard Sekretaris Paroki
                </a>
                <a href="{{ route('dashboard.romo-paroki') }}" class="block py-2.5 px-4 rounded transition duration-200
                    {{ Request::routeIs('dashboard.romo-paroki') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    Dashboard Romo Paroki
                </a>

                <div class="mt-4 border-t border-gray-700 pt-4">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Logout
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
    </nav>
</div>