<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planet;
use Illuminate\Support\Facades\DB;


class DestinationController extends Controller
{
    // Affiche la première planète (appelé via /destination)
    public function index()
    {
        $planets = Planet::all();
        $planet = $planets->first(); // Charge la première planète

        return view('vue.destination', compact('planet', 'planets'));
    }

    // Affiche une planète précise via le slug (appelé via /destination/{slug})
  public function show($slug)
{
    $locale = app()->getLocale();
    
    // Trouver la planète correspondant au slug FR ou EN
    $planet = Planet::select("name_$locale as name", "description_$locale as description", "distance", "duration", "image")
        ->where('slug_fr', $slug)
        ->orWhere('slug_en', $slug)
        ->firstOrFail();
    //  dump($planet);
    // Toutes les planètes pour le menu (Lune / Mars / Europa / Titan)
    $planets = Planet::all();

    return view('vue.destination', compact('planet', 'planets'));
}

}