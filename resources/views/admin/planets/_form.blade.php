<x-app-layout>
<div class="grid grid-cols-1 gap-4">

    {{-- Nom (FR) --}}
    <div>
        <label class="block text-sm font-medium">Nom (FR)</label>
        <input class="mt-1 w-full border rounded-md p-2"
               type="text" name="name_fr"
               value="{{ old('name_fr', $planet->name_fr ?? '') }}">
        @error('name_fr') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Nom (EN) --}}
    <div>
        <label class="block text-sm font-medium">Nom (EN)</label>
        <input class="mt-1 w-full border rounded-md p-2"
               type="text" name="name_en"
               value="{{ old('name_en', $planet->name_en ?? '') }}">
        @error('name_en') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- ✅ Slug (nouveau champ) --}}
    <div>
        <label class="block text-sm font-medium">Slug (identifiant URL)</label>
        <input class="mt-1 w-full border rounded-md p-2"
               type="text" name="slug"
               placeholder="ex: europe, mars, titan"
               value="{{ old('slug', $planet->slug ?? '') }}">
        <p class="text-xs text-gray-500 mt-1">
            Ce champ détermine l’adresse dans l’URL (ex. <code>/destination/mars</code>)
        </p>
        @error('slug') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Description (FR) --}}
    <div>
        <label class="block text-sm font-medium">Description (FR)</label>
        <textarea class="mt-1 w-full border rounded-md p-2" name="description_fr">{{ old('description_fr', $planet->description_fr ?? '') }}</textarea>
        @error('description_fr') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Description (EN) --}}
    <div>
        <label class="block text-sm font-medium">Description (EN)</label>
        <textarea class="mt-1 w-full border rounded-md p-2" name="description_en">{{ old('description_en', $planet->description_en ?? '') }}</textarea>
        @error('description_en') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
    </div>

    {{-- Distance + Durée --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Distance</label>
            <input class="mt-1 w-full border rounded-md p-2"
                   type="text" name="distance"
                   value="{{ old('distance', $planet->distance ?? '') }}">
            @error('distance') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Durée</label>
            <input class="mt-1 w-full border rounded-md p-2"
                   type="text" name="duration"
                   value="{{ old('duration', $planet->duration ?? '') }}">
            @error('duration') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- Image --}}
    <div>
        <label class="block text-sm font-medium">Image</label>
        <input class="mt-1 w-full" type="file" name="image">
        @error('image') <div class="text-sm text-red-600">{{ $message }}</div> @enderror

        @if(!empty($planet?->image))
            <div class="mt-2">
                <img src="{{ asset('storage/'.$planet->image) }}" alt="{{ $planet->name_fr ?? '' }}" class="h-24 rounded">
            </div>
        @endif
    </div>
</div>
</x-app-layout>
