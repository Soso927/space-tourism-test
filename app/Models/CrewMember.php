<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CrewMember extends Model
{
    protected $fillable = [
        'slug',
        'name_fr',
        'name_en',
        'role_fr',
        'role_en',
        'bio_fr',
        'bio_en',
        'image',
    ];

    // Génère le slug automatiquement à la création
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $member->slug = Str::slug($member->name_en);
        });

        static::updating(function ($member) {
            if ($member->isDirty('name_en')) {
                $member->slug = Str::slug($member->name_en);
            }
        });
    }
}