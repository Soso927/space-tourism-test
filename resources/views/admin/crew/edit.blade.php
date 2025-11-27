{{-- resources/views/admin/crew/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un membre de l'équipage
        </h2>
    </x-slot>

    <section class="max-w-4xl mx-auto px-6 py-8">

        {{-- Titre + retour --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Modifier un membre</h1>
            <a href="{{ route('admin.crew.index') }}" class="underline">Retour à la liste</a>
        </div>

        {{-- Formulaire --}}
        <form action="{{ route('admin.crew.update', $crewMember->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">

                {{-- Nom FR --}}
                <div>
                    <label class="block text-sm font-medium">Nom (FR)</label>
                    <input type="text" name="name_fr" value="{{ old('name_fr', $crewMember->name_fr) }}"
                        class="mt-1 w-full border rounded-md p-2" required>
                    @error('name_fr')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nom EN --}}
                <div>
                    <label class="block text-sm font-medium">Nom (EN)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $crewMember->name_en) }}"
                        class="mt-1 w-full border rounded-md p-2" required>
                    @error('name_en')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Rôle FR --}}
                <div>
                    <label class="block text-sm font-medium">Rôle (FR)</label>
                    <input type="text" name="role_fr" value="{{ old('role_fr', $crewMember->role_fr) }}"
                        class="mt-1 w-full border rounded-md p-2" required>
                    @error('role_fr')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Rôle EN --}}
                <div>
                    <label class="block text-sm font-medium">Rôle (EN)</label>
                    <input type="text" name="role_en" value="{{ old('role_en', $crewMember->role_en) }}"
                        class="mt-1 w-full border rounded-md p-2" required>
                    @error('role_en')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bio FR --}}
                <div>
                    <label class="block text-sm font-medium">Biographie (FR)</label>
                    <textarea name="bio_fr" rows="4" class="mt-1 w-full border rounded-md p-2" required>{{ old('bio_fr', $crewMember->bio_fr) }}</textarea>
                    @error('bio_fr')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bio EN --}}
                <div>
                    <label class="block text-sm font-medium">Biographie (EN)</label>
                    <textarea name="bio_en" rows="4" class="mt-1 w-full border rounded-md p-2" required>{{ old('bio_en', $crewMember->bio_en) }}</textarea>
                    @error('bio_en')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image actuelle --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Image actuelle</label>

                    @if ($crewMember->image)
                        <img src="{{ asset('storage/' . $crewMember->image) }}"
                            class="w-32 h-32 object-cover rounded-md border">
                    @else
                        <p class="text-sm text-gray-500">Aucune image disponible</p>
                    @endif
                </div>

                {{-- Nouvelle image --}}
                <div>
                    <label class="block text-sm font-medium">Nouvelle image (optionnel)</label>
                    <input type="file" name="image" class="mt-1 w-full" accept="image/*">
                    @error('image')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bouton de validation --}}
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Mettre à jour
                    </button>
                </div>

            </div>
        </form>

    </section>
</x-app-layout>