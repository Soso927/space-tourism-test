<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    protected $fillable = [
        'slug',
        'name_fr',
        'name_en',
        'description_fr',
        'description_en',
        'image',
        'order',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($technology) {
            $technology->slug = Str::slug($technology->name_en);
        });

        static::updating(function ($technology) {
            if ($technology->isDirty('name_en')) {
                $technology->slug = Str::slug($technology->name_en);
            }
        });
    }
}