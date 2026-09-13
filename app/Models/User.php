<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'surname', 
    'name', 
    'patronymic', 
    'is_verified', 
    'email', 
    'password',
    'udsu_id'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'is_verified'=> 'boolean',
            'is_admin'=> 'boolean',
        ];
    }

    public function isVerified(): bool
    {
        return ! $this->is_verified ?? false;
    }

    public function isAdmin(): bool
    {
        return ! $this->is_admin;
    }

    public function fullName(): string
    {
        return "$this->surname $this->name";
    }
}
