<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_jp',
        'content_en',
        'content_jp',
        'slug',
        'meta_description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->title_jp : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'jp' ? $this->content_jp : $this->content_en;
    }
}