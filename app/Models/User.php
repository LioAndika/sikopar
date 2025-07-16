<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // <--- Anda sudah menghapus ini, bagus!

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <--- Anda sudah menghapus 'HasApiTokens,', bagus!

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'stasi_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi dengan Role (perbaikan)
    public function role() // Ubah dari 'roles' menjadi 'role' karena ini relasi belongsTo (satu user punya satu role)
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi dengan Stasi (jika ada)
    public function stasi()
    {
        return $this->belongsTo(Stasi::class); // Pastikan model Stasi ada
    }

    // Helper untuk mengecek peran (perbaikan dan saran)
    public function hasRole($roleSlug) // Ganti $role menjadi $roleSlug agar lebih jelas
    {
        // Pastikan role ada sebelum mengakses propertinya
        // Menggunakan optional() sangat disarankan untuk rantai method
        return optional($this->role)->slug === $roleSlug;
        
        // Atau cara lain yang lebih eksplisit jika tidak ingin menggunakan optional()
        // return $this->role !== null && $this->role->slug === $roleSlug;

        // Jika Anda menggunakan Spatie Permission, method ini akan diganti dengan built-in method `hasRole()` mereka.
    }

    // Saran: tambahkan method untuk mengecek apakah user adalah Super Admin
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin'); // Sesuaikan slug role super admin Anda
    }

    // Saran: method untuk assign role (jika Anda tidak menggunakan Spatie Permission)
    // Ini membantu menjaga konsistensi daripada langsung mengubah role_id
    public function assignRole($roleSlug)
    {
        $role = Role::where('slug', $roleSlug)->first();
        if ($role) {
            $this->role_id = $role->id;
            $this->save();
            return true;
        }
        return false;
    }
}