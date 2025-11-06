<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Planet;

class PlanetSeeder extends Seeder
{
    public function run(): void
    {
        $planets = [
            [
                'id' =>'1',                   
                'name' => 'Moon',
                'description' => 'See our planet as you’ve never seen it before. A perfect relaxing trip to take a step back and recharge.',
                'distance' => '384,000 km',
                'duration' => '3 days',
                'image' => 'public\images\moon.webp',
            ],
            [
                'id' =>'2',
                'name' => 'Mars',
                'description' => 'Don’t forget your hiking boots. Mars has the tallest mountain in the solar system!',
                'distance' => '225 mil. km',
                'duration' => '9 months',
                'image' => 'public\images\mars.webp',
            ],
            [
                'id' =>'3',
                'name' => 'Europa',
                'description' => 'The smallest of the four Galilean moons orbiting Jupiter, Europa is a winter lover’s dream.',
                'distance' => '628 mil. km',
                'duration' => '3 years',
                'image' => 'public\images\europa.webp',
            ],
            [
                'id' =>'4',
                'name' => 'Titan',
                'description' => 'The only moon known to have a dense atmosphere other than Earth, Titan is a home away from home.',
                'distance' => '1.6 bil. km',
                'duration' => '7 years',
                'image' => 'public\images\titan.webp',
            ],
        ];

        foreach ($planets as $planet) {
            Planet::create($planet);
        }
    }
}
