<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRoleOrIsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roleSlug  Slug peran yang diperlukan (misal: 'bendahara-stasi')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $roleSlug): Response
    {
        $user = Auth::user();

        // Jika pengguna tidak terautentikasi, alihkan ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Jika pengguna adalah Super Admin, izinkan akses ke semua fitur
        // ATAU jika pengguna memiliki peran yang diperlukan, izinkan akses
        if ($user->isSuperAdmin() || $user->hasRole($roleSlug)) {
            return $next($request);
        }

        // Jika tidak diizinkan, kembalikan respon 403 Forbidden
        abort(403, 'Anda tidak memiliki hak akses untuk fitur ini.');
    }
}