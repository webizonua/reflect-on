<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'title',
        'description',
        'keywords',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getUrlAttribute(): string
    {
        // например /mein-angebot
        return url($this->slug);
    }

    public function getRouteUrlAttribute(): string
    {
        return '/' . $this->slug;
    }
}
