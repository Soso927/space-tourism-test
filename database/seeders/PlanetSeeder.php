<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Planet;
use Illuminate\Support\Str;

class PlanetSeeder extends Seeder
{
    public function run(): void
    {
        $planets = [
            [
                'name_fr'      => 'Lune',
                'name_en'      => 'Moon',
                'slug'         => Str::slug('Moon'),
                'description_fr' => 'Voyez notre planète comme vous ne l’avez jamais vue auparavant.',
                'description_en' => 'See our planet as you’ve never seen it before. A perfect relaxing trip to recharge.',
                'distance'     => '384,000 km',
                'duration'     => '3 days',
                'image'        => 'images/moon.webp',
            ],
            [
                'name_fr'      => 'Mars',
                'name_en'      => 'Mars',
                'slug'         => Str::slug('Mars'),
                'description_fr' => 'N’oubliez pas vos bottes de randonnée. Mars possède la plus haute montagne du système solaire.',
                'description_en' => 'Don’t forget your hiking boots. Mars has the tallest mountain in the solar system!',
                'distance'     => '225 mil. km',
                'duration'     => '9 months',
                'image'        => 'images/mars.webp',
            ],
            [
                'name_fr'      => 'Europe',
                'name_en'      => 'Europa',
                'slug'         => Str::slug('Europa'),
                'description_fr' => 'Un paradis glacé pour les amoureux de l’hiver.',
                'description_en' => 'The smallest of the Galilean moons, Europa is a winter lover’s dream.',
                'distance'     => '628 mil. km',
                'duration'     => '3 years',
                'image'        => 'images/europa.webp',
            ],
            [
                'name_fr'      => 'Titan',
                'name_en'      => 'Titan',
                'slug'         => Str::slug('Titan'),
                'description_fr' => 'Une lune avec une atmosphère dense, un second foyer.',
                'description_en' => 'Titan is the only moon with a dense atmosphere besides Earth.',
                'distance'     => '1.6 bil. km',
                'duration'     => '7 years',
                'image'        => 'images/titan.webp',
            ],
        ];

        foreach ($planets as $planet) {
            Planet::create($planet);
        }
    }
}
