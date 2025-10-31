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
    Schema::table('planets', function (Blueprint $table) {
        // ajoute une colonne 'name' unique après l'id
        $table->string('name')->unique()->after('id');
    });
}

public function down(): void
{
    Schema::table('planets', function (Blueprint $table) {
        // si tu veux être ultra-prudent, enlève d'abord l'index unique
        $table->dropUnique('planets_name_unique'); // nom par convention: {table}_{col}_unique
        $table->dropColumn('name');
    });
}

};
