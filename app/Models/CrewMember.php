<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
      protected $fillable = [
        'name_fr','name_en',
        'role_fr','role_en',
        'bio_fr','bio_en',
        'image'
    ];
}
