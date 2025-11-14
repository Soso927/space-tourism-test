<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planet;

class DestinationController extends Controller
{
       public function index($planetId = null)
    {
        $planets = Planet::all();

        $planet = $planetId
            ? Planet::findOrFail($planetId)
            : $planets->first();

        return view('destination', compact('planets', 'planet'));
    }
    public function publicShow(int $id) {
       $data = Planet::query()->select('name_fr','description_fr','image','distance','duration')->where('id','=',$id)->first();
        

        return view ('vue.destination', compact('data'));
    }
     public function show($slug)
    {
        // Récupération de toutes les planètes pour le menu
        $planets = Planet::all();

        // On récupère la planète correspondant au slug
        $planet = Planet::where('slug', $slug)->first();

        // Si slug invalide : fallback vers la première planète
        if (!$planet) {
            $planet = $planets->first();
        }

        return view('destination', [
            'planets' => $planets,
            'planet'  => $planet
        ]);
    }

}
