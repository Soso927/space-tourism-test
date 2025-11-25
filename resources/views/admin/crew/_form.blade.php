{{-- Ce fichier ne doit contenir que le contenu du formulaire, pas le layout <x-app-layout> --}}

<div class="grid grid-cols-1 gap-6">

    {{-- Nom / Name et Rôle / Role sur deux colonnes --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Nom complet (FR) --}}
        <div>
            <label for="name_fr" class="block text-sm font-medium">Nom complet</label>
            <input id="name_fr" class="mt-1 w-full border rounded-md p-2"
                   type="text" name="name_fr"
                   placeholder="ex : Douglas Hurley"
                   value="{{ old('name', $crewMember->name ?? '') }}" required>
            @error('name') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        {{-- Name (EN) --}}
        <div>
            <label for="name_en" class="block text-sm font-medium">Full Name (EN)</label>
            <input id="name_en" class="mt-1 w-full border rounded-md p-2"
                   type="text" name="name_en"
                   placeholder="e.g.: Douglas Hurley"
                   value="{{ old('name_en', $crewMember->name_en ?? '') }}" required>
            @error('name_en') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        {{-- Rôle (FR) --}}
        <div>
            <label for="role_fr" class="block text-sm font-medium">Rôle (ex : Commander)</label>
            <input id="role_fr" class="mt-1 w-full border rounded-md p-2"
                   type="text" name="role"
                   placeholder="ex : Commander"
                   value="{{ old('role', $crewMember->role ?? '') }}" required>
            @error('role') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        {{-- Role (EN) --}}
        <div>
            <label for="role_en" class="block text-sm font-medium">Role (EN)</label>
            <input id="role_en" class="mt-1 w-full border rounded-md p-2"
                   type="text" name="role_en"
                   placeholder="e.g.: Commander"
                   value="{{ old('role_en', $crewMember->role_en ?? '') }}" required>
            @error('role_en') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

    </div>

    {{-- Biographie (FR) --}}
    <div>
        <label for="bio_fr" class="block text-sm font-medium">Biographie</label>
        <textarea id="bio_fr" class="mt-1 w-full border rounded-md p-2 h-32" 
                  name="bio_fr"
                  placeholder="Brève biographie du membre d'équipage..." required>{{ old('bio', $crewMember->bio ?? '') }}</textarea>
        @error('bio_fr') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Biography (EN) --}}
    <div>
        <label for="bio_en" class="block text-sm font-medium">Biography (EN)</label>
        <textarea id="bio_en" class="mt-1 w-full border rounded-md p-2 h-32" 
                  name="bio_en"
                  placeholder="Brief biography of the crew member..." required>{{ old('bio_en', $crewMember->bio_en ?? '') }}</textarea>
        @error('bio_en') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Image --}}
    <div>
        <label for="image" class="block text-sm font-medium">Image (portrait)</label>
        <input id="image" class="mt-1 w-full" type="file" name="image" accept="image/*">
        @error('image') <div class="text-sm text-red-600">{{ $message }}</div> @enderror

        {{-- Prévisualisation image existante --}}
        @if(!empty($crewMember?->image))
            <div class="mt-2">
                <p class="text-xs text-gray-500 mb-1">Image actuelle :</p>
                <img src="{{ asset('storage/'.$crewMember->image) }}" 
                     alt="Image de {{ $crewMember->name ?? 'l\'équipage' }}" 
                     class="h-24 rounded object-cover border border-gray-200">
            </div>
        @endif
    </div>

</div>
