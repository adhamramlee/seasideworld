<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title_en',
        'title_jp',
        'description_en',
        'description_jp',
        'file_path',
        'file_size',
        'file_type',
        'downloads',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'downloads' => 'integer',
        'file_size' => 'integer',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->title_jp : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->description_jp : $this->description_en;
    }

    public function getSizeForHumansAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes <= 0) {
            return '0 B';
        }
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}