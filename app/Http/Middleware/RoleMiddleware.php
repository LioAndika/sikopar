<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke login jika belum autentikasi
        }

        $user = Auth::user();

        // Jika user tidak memiliki role atau rolenya belum terdefinisi
        if (!$user->role) {
            Auth::logout(); // Logout user yang tidak memiliki role yang valid
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors(['message' => 'Akun Anda tidak memiliki peran yang valid.']);
        }

        // Cek apakah role user sesuai dengan role yang diizinkan
        if (!in_array($user->role->slug, $roles)) {
            // Jika tidak diizinkan, redirect ke halaman sebelumnya atau halaman error
            // Atau bisa juga ke dashboard sesuai role jika memang aksesnya valid tapi bukan untuk halaman ini
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}