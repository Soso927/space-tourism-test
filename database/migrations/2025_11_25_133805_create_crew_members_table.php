<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->id();

            // Champs FR
            $table->string('name_fr');
            $table->string('role_fr');
            $table->text('bio_fr');

            // Champs EN
            $table->string('name_en');
            $table->string('role_en');
            $table->text('bio_en');

            // Image
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_members');
    }
};
