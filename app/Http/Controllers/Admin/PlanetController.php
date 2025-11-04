<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PlanetController extends Controller
{
    /**
     * Liste paginée des planètes.
     */
    public function index(): View
    {
        $planets = Planet::latest()->paginate(10);
        return view('admin.planets.index', compact('planets'));
    }

    /**
     * Formulaire de création.
     */
    public function create(): View
    {
        $planet = new Planet();
        return view('admin.planets.create', compact('planet'));
    }

    /**
     * Enregistre une planète.
     */
    public function store(Request $request): RedirectResponse
    {

        // 1) Données validées (depuis PlanetRequest)
        $validate = $request->validate([
            // 'name' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:planets,name'],
            'name_fr' => ['required', 'string', 'max:150'],
            'name_en' => ['required', 'string', 'max:150'],
            'description_fr' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'distance' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'integer', 'min:0'],
            'image'=> ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],


        ]);
        // dd($validate);
        // 3) Upload image (si fournie)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('planets', 'public'); // => storage/app/public/planets/...
            $attributes['image'] = $path;
        }
        // Création de la planète
        $planet = Planet::create($validate);
        // Redirection après succès
        return redirect()->route('admin.planets.index')
            ->with('success', 'Planète créée avec succès !');
    }

    /**
     * Formulaire d’édition.
     */
    public function edit(Planet $planet): View
    {
        return view('admin.planets.edit', compact('planet'));
    }

    /**
     * Met à jour une planète.
     */
public function update(Request $request, Planet $planet): RedirectResponse
{
    $validated = $request->validate([
        'name_fr' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'description_fr' => 'nullable|string',
        'description_en' => 'nullable|string',
        'distance' => 'required|numeric',
        'duration' => 'required|numeric',
        'image' => 'nullable|image|max:2048',
    ]);

    // Gestion de l’image
    if ($request->hasFile('image')) {
        if (!empty($planet->image) && Storage::disk('public')->exists($planet->image)) {
            Storage::disk('public')->delete($planet->image);
        }
        $validated['image'] = $request->file('image')->store('planets', 'public');
    }

    $planet->update($validated);

    return redirect()
        ->route('admin.planets.index')
        ->with('status', 'Planète mise à jour avec succès.');
}

    /**
     * Supprime une planète (et son image associée).
     */
    public function destroy(Planet $planet): RedirectResponse
    {
        // Supprime le fichier image s’il existe
        if (!empty($planet->image) && Storage::disk('public')->exists($planet->image)) {
            Storage::disk('public')->delete($planet->image);
        }

        $planet->delete();

        return redirect()
            ->route('admin.planets.index')
            ->with('status', 'Planète supprimée avec succès.');
    }

}
