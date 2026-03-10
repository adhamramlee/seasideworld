<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'phone',
        'company',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function dashboardRoute(): string
    {
        return $this->isAdmin() ? route('admin.dashboard', absolute: false) : route('client.dashboard', absolute: false);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class)->withTimestamps();
    }

    public function uploadedDocuments()
    {
        return $this->hasMany(Document::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}