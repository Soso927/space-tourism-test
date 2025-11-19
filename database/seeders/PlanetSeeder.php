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
                'name_fr'        => 'Lune',
                'name_en'        => 'Moon',
                'slug_fr'        => Str::slug('Lune'),
                'slug_en'        => Str::slug('Moon'),
                'description_fr' => "Voyez notre planète comme vous ne l'avez jamais vue auparavant. Un parfait voayage de détente pour vous aider à prendre du recul et revenir requinquer. Pendant que vous y êtes, plangez-vous dans l'histoire en visitant les sites d'atterrissage de Luna 2 et Apollo 11.",
                'description_en' => "See our planet as you've never seen it before. A perfect relaxing trip to help you step back and recharge your batteries. While you're there, immerse yourself in history by visiting the landing sites of Luna 2 and Apollo 11.",
                'distance'       => '384 000 ',
                'duration'       => '3 ',
                'image'          => 'images/moon.webp',
            ],
            [
                'name_fr'        => 'Mars',
                'name_en'        => 'Mars',
                'slug_fr'        => Str::slug('Mars'),
                'slug_en'        => Str::slug('Mars'),
                'description_fr' => "N'oubliez pas vos bottes de randonnée. Vous en aurez besoin pour gravir le mont Olympus, la plus haute montagne planétaire dans notre système solaire. Il fait deux fois et demie la taille de l'Everest !",
                'description_en' => "Don't forget your hiking boots. You'll need them to climb Mount Olympus, the tallest mountain in our solar system. It's two and a half times the size of Everest!",
                'distance'       => '225 000 000 ',
                'duration'       => '9',
                'image'          => 'images/mars.webp',
            ],
            [
                'name_fr'        => 'Europe',
                'name_en'        => 'Europa',
                'slug_fr'        => Str::slug('Europe'),
                'slug_en'        => Str::slug('Europa'),
                'description_fr' => "La plus petite des quatre lunes galiléennes en orbite autour de Jupiter, Europe est le rêve des amoureux de  l'hiver. Sa surface glacée est parfaite pour faire un peu de patin à glace, du curling, du hockey ou tout simplement pour vous détentre dans votre confortable chalet hivernal.",
                'description_en' => "The smallest of the four Galilean moons orbiting Jupiter, Europa is a winter lover's dream. Its icy surface is perfect for ice skating, curling, hockey, or simply relaxing in your cozy winter cabin. ",
                'distance'       => '628 000 000 ',
                'duration'       => '3',
                'image'          => 'images/europa.webp',
            ],
            [
                'name_fr'        => 'Titan',
                'name_en'        => 'Titan',
                'slug_fr'        => Str::slug('Titan'),
                'slug_en'        => Str::slug('Titan'),
                'description_fr' => "La seule lune connue pour avoir une atmosphère dense autre que la Terre, Titan est comme une maison loin de la maison (et juste quelques centaines de degrés plus froid !). En bonus, vous pouvez contemplez des vues saisissantes des anneaux de Saturne.",
                'description_en' => "The only moon known to have a dense atmosphere other than Earth, Titan is like a home away from home (and just a few hundred degrees colder!). As a bonus, you can enjoy breathtaking views of Saturn's rings.",
                'distance'       => '1 600 000 000 ',
                'duration'       => '7 ',
                'image'          => 'images/titan.webp',
            ],
        ];

        foreach ($planets as $planet) {
            Planet::create($planet);
        }
    }
}
