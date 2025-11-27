<?php

namespace App\Http\Controllers;

use App\Models\CrewMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrewMemberController extends Controller
{
    public function index()
    {
        $crewMembers = CrewMember::paginate(10);
        return view('admin.crew.index', compact('crewMembers'));
    }

    public function create()
    {
        return view('admin.crew.create');
    }

public function store(Request $request)
{
    $data = $request->validate([
        'name_fr' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'role_fr' => 'required|string|max:255',
        'role_en' => 'required|string|max:255',
        'bio_fr' => 'required|string',
        'bio_en' => 'required|string',
        'image' => 'required|image|max:2048',
    ]);

    // Correction ici
    $data['image'] = $request->file('image')->store('crew', 'public');

    CrewMember::create($data);

    return redirect()
        ->route('admin.crew.index')
        ->with('success', 'Membre ajouté !');
}
//     public function edit($id)
// {
//     $crewMember = CrewMember::find($id);

//     dd($id, $crewMember);
// }

  public function edit($id)
{
    $crewMember = CrewMember::findOrFail($id);
    // dd($crewMember);
    return view('admin.crew.edit', compact('crewMember'));
}

    public function update(Request $request, CrewMember $crewMember)
    {
      $data = $request->validate([
        'name_fr' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'role_fr' => 'required|string|max:255',
        'role_en' => 'required|string|max:255',
        'bio_fr' => 'required|string',
        'bio_en' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($crewMember->image) {
            Storage::disk('public')->delete($crewMember->image);
        }
        $data['image'] = $request->file('image')->store('crew', 'public');
    }

    $crewMember->update($data);

    return redirect()->route('admin.crew.index')->with('success', 'Membre mis à jour !');
    }

    public function destroy(CrewMember $crewMember)
    {
        if ($crewMember->image) {
            Storage::disk('public')->delete($crewMember->image);
        }
        $crewMember->delete();
        return redirect()->route('admin.crew.index')->with('success', 'Membre supprimé.');
    }
}
