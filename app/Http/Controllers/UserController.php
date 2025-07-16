<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Stasi; // Penting: Tambahkan ini untuk mengakses model Stasi
use Illuminate\Support\Facades\Hash; // Gunakan Hash::make() untuk password
use Illuminate\Validation\Rule; // Tambahkan ini untuk validasi kondisional

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Eager load role dan stasi untuk menghindari N+1 query problem di view
        $users = User::with(['role', 'stasi'])->get();
        return view('super_admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        $stasis = Stasi::all(); // Ambil semua stasi untuk dropdown
        return view('super_admin.users.create', compact('roles', 'stasis')); // Kirimkan 'stasis' ke view
    }

    /**
     * Menyimpan user baru ke database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'stasi_id' => [
                'nullable', // Stasi bisa null untuk role tertentu
                'exists:stasi,id', // Pastikan ID stasi ada di tabel stasi (singular)
                // Validasi kondisional: stasi_id wajib jika role adalah bendahara-stasi atau ketua-stasi
                Rule::requiredIf(function () use ($request) {
                    $role = Role::find($request->role_id);
                    return $role && in_array($role->slug, ['bendahara-stasi', 'ketua-stasi']);
                }),
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Gunakan Hash::make()
            'role_id' => $request->role_id,
            'stasi_id' => $request->stasi_id,
        ]);

        return redirect()->route('super-admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit user yang ada.
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $stasis = Stasi::all(); // Ambil semua stasi untuk dropdown
        return view('super_admin.users.edit', compact('user', 'roles', 'stasis')); // Kirimkan 'stasis' ke view
    }

    /**
     * Memperbarui user yang ada di database.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Memastikan email unik kecuali untuk user itu sendiri
            ],
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            'role_id' => 'required|exists:roles,id',
            'stasi_id' => [
                'nullable',
                'exists:stasi,id', // Pastikan ID stasi ada di tabel stasi (singular)
                Rule::requiredIf(function () use ($request) {
                    $role = Role::find($request->role_id);
                    return $role && in_array($role->slug, ['bendahara-stasi', 'ketua-stasi']);
                }),
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) { // Gunakan filled() untuk mengecek apakah ada input password
            $user->password = Hash::make($request->password); // Gunakan Hash::make()
        }
        $user->role_id = $request->role_id;
        $user->stasi_id = $request->stasi_id;
        $user->save();

        return redirect()->route('super-admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('super-admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}