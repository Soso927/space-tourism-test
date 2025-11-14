<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        return view('admin.planets.create', ['planet' => new Planet()]);
    }

    /**
     * Enregistre une planète.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_fr' => ['required', 'string', 'max:150'],
            'name_en' => ['required', 'string', 'max:150'],
            'description_fr' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'distance' => ['required', 'string'],
            'duration' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'slug' => ['nullable', 'string', 'unique:planets,slug', 'max:255'],
        ]);

        // 🔧 Génération automatique du slug si vide
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_fr'], '-');
        }

        // 📸 Upload image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('planets', 'public');
        }

        Planet::create($validated);

        return redirect()
            ->route('admin.planets.index')
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
            'name_fr' => ['required', 'string', 'max:150'],
            'name_en' => ['required', 'string', 'max:150'],
            'description_fr' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'distance' => ['required', 'string'],
            'duration' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'slug' => ['nullable', 'string', 'max:255', "unique:planets,slug,{$planet->id}"],
        ]);

        // slug auto si vide
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_fr'], '-');
        }

        // 📸 Gestion de l’image
        if ($request->hasFile('image')) {
            if (!empty($planet->image) && Storage::disk('public')->exists($planet->image)) {
                Storage::disk('public')->delete($planet->image);
            }

            $validated['image'] = $request->file('image')->store('planets', 'public');
        }

        $planet->update($validated);

        return redirect()
            ->route('admin.planets.index')
            ->with('success', 'Planète mise à jour avec succès !');
    }

    /**
     * Supprime une planète.
     */
    public function destroy(Planet $planet): RedirectResponse
    {
        if ($planet->image && Storage::disk('public')->exists($planet->image)) {
            Storage::disk('public')->delete($planet->image);
        }

        $planet->delete();

        return redirect()
            ->route('admin.planets.index')
            ->with('success', 'Planète supprimée avec succès !');
    }
}
