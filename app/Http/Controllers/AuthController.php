<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User diimport

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Jika user sudah login, redirect ke dashboard yang sesuai
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan peran (role)
            return $this->redirectToDashboard(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }

    /**
     * Memproses permintaan logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        // Ini adalah rute logout default yang selalu mengarahkan ke landing page
        return redirect()->route('landing');
    }

    /**
     * Mengarahkan user ke dashboard yang sesuai berdasarkan perannya.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToDashboard(User $user)
    {
        if ($user->hasRole('super-admin')) {
            return redirect()->intended('/dashboard/super-admin');
        } elseif ($user->hasRole('bendahara-stasi')) {
            return redirect()->intended('/dashboard/bendahara-stasi');
        } elseif ($user->hasRole('ketua-stasi')) {
            return redirect()->intended('/dashboard/ketua-stasi');
        } elseif ($user->hasRole('bendahara-paroki')) {
            return redirect()->intended('/dashboard/bendahara-paroki');
        } elseif ($user->hasRole('sekretaris-paroki')) {
            return redirect()->intended('/dashboard/sekretaris-paroki');
        } elseif ($user->hasRole('romo-paroki')) {
            return redirect()->intended('/dashboard/romo-paroki');
        }

        // Default redirect jika role tidak ditemukan atau belum diset
        return redirect()->intended('/dashboard');
    }
}