<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planet;

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
    public function show(string $slug)
    {
        $planets = Planet::all();
        $planet = Planet::where('slug', $slug)->firstOrFail();

        return view('vue.destination', compact('planet', 'planets'));
    }
}
