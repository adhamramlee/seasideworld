<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en',
        'name_jp',
        'description_en',
        'description_jp',
        'year',
        'price',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(VehicleImage::class)->where('is_primary', true);
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