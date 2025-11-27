<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('crew_members')->insert([
            [
                'name' => 'Douglas Hurley',
                'role' => 'Flight Engineer',
                'bio_en' => 'Douglas Gerald Hurley is an American engineer, former Marine Corps pilot and former NASA astronaut. He launched into space for the third time as commander of the SpaceX Demo-2 mission.',
                'bio_fr' => 'Douglas Gerald Hurley est un ingénieur américain, ancien pilote du Corps des Marines et ancien astronaute de la NASA.',
                'image' => 'images/image-douglas-hurley.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mark Shuttleworth',
                'role' => 'Mission Specialist',
                'bio_en' => 'Mark Richard Shuttleworth is the founder and chairman of Canonical, the company behind the Linux-based Ubuntu operating system.',
                'bio_fr' => 'Mark Richard Shuttleworth est le fondateur et président de Canonical, la société derrière le système d\'exploitation Ubuntu.',
                'image' => 'images/image-mark-shuttleworth.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Victor Glover',
                'role' => 'Pilot',
                'bio_en' => 'Victor Glover is a NASA astronaut and former U.S. Navy pilot. He made his first spaceflight as pilot of the SpaceX Crew-1 mission.',
                'bio_fr' => 'Victor Glover est un astronaute de la NASA et ancien pilote de la Marine américaine.',
                'image' => 'images/image-victor-glover.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anousheh Ansari',
                'role' => 'Flight Engineer',
                'bio_en' => 'Anousheh Ansari is an Iranian American engineer and co-founder of Prodea Systems. Ansari was the fourth tourist to visit the ISS.',
                'bio_fr' => 'Anousheh Ansari est une ingénieure américano-iranienne et cofondatrice de Prodea Systems.',
                'image' => 'images/image-anousheh-ansari.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}