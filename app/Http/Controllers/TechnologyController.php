<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    // Liste des technologies (admin)
    public function index()
    {
        $technologies = Technology::orderBy('order')->paginate(10);
        return view('admin.technologies.index', compact('technologies'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.technologies.create');
    }

    // Enregistrer une nouvelle technologie
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $data['image'] = $request->file('image')->store('technologies', 'public');
        Technology::create($data);

        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie ajoutée !');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $technology = Technology::findOrFail($id);
        return view('admin.technologies.edit', compact('technology'));
    }

    // Mettre à jour une technologie
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($technology->image) {
                Storage::disk('public')->delete($technology->image);
            }
            $data['image'] = $request->file('image')->store('technologies', 'public');
        }

        $technology->update($data);

        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie mise à jour !');
    }

    // Supprimer une technologie
    public function destroy(Technology $technology)
    {
        if ($technology->image) {
            Storage::disk('public')->delete($technology->image);
        }
        
        $technology->delete();

        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie supprimée !');
    }

    // Affichage public
    public function show(?string $slug = null)
    {
        if (!$slug) {
            $technology = Technology::orderBy('order')->first();
            
            if (!$technology) {
                abort(404, 'Aucune technologie trouvée');
            }
        } else {
            $technology = Technology::where('slug', $slug)->firstOrFail();
        }
        
        $allTechnologies = Technology::orderBy('order')->get();
        
        return view('vue.technologie', [
            'technology' => $technology,
            'allTechnologies' => $allTechnologies,
        ]);
    }
}