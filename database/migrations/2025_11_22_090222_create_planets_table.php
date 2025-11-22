<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            
            // Champs traduits (requis par ton contrôleur)
            $table->string('slug_fr')->unique();
            $table->string('slug_en')->unique();
            
            $table->string('name_fr');
            $table->string('name_en');
            
            $table->text('description_fr');
            $table->text('description_en');
            
            // Champs communs
            $table->string('distance');
            $table->string('duration');
            $table->string('image');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};