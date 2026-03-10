<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_jp',
        'slug',
        'description_en',
        'description_jp',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->name_jp : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->description_jp : $this->description_en;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}