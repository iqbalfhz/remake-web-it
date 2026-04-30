<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'is_admin', 'is_approved', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Tier hirarki admin panel.
     * Semakin kecil angkanya, semakin tinggi kewenangannya.
     * 1 = super-admin, 2 = admin, 3 = editor, 4 = staff, 99 = no role
     */
    public function adminTier(): int
    {
        if ($this->is_admin || $this->hasRole('super-admin')) {
            return 1;
        }

        if ($this->hasRole('admin')) {
            return 2;
        }

        if ($this->hasRole('editor')) {
            return 3;
        }

        if ($this->hasRole('staff')) {
            return 4;
        }

        return 99;
    }
}
