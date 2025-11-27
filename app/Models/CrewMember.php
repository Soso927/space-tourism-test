<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_fr',
        'name_en',
        'role_fr',
        'role_en',
        'bio_fr',
        'bio_en',
        'image',
    ];
}