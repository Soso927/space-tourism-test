<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Nom FR -->
    <div>
        <label for="name_fr" class="block text-sm font-medium text-gray-700">Nom (Français)</label>
        <input type="text" name="name_fr" id="name_fr" 
               value="{{ old('name_fr', $technology->name_fr ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
               required>
        @error('name_fr')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Nom EN -->
    <div>
        <label for="name_en" class="block text-sm font-medium text-gray-700">Nom (Anglais)</label>
        <input type="text" name="name_en" id="name_en" 
               value="{{ old('name_en', $technology->name_en ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
               required>
        @error('name_en')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description FR -->
    <div>
        <label for="description_fr" class="block text-sm font-medium text-gray-700">Description (Français)</label>
        <textarea name="description_fr" id="description_fr" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  required>{{ old('description_fr', $technology->description_fr ?? '') }}</textarea>
        @error('description_fr')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description EN -->
    <div>
        <label for="description_en" class="block text-sm font-medium text-gray-700">Description (Anglais)</label>
        <textarea name="description_en" id="description_en" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  required>{{ old('description_en', $technology->description_en ?? '') }}</textarea>
        @error('description_en')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image -->
    <div class="md:col-span-2">
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        @if(isset($technology) && $technology->image)
            <div class="mt-2 mb-2">
                <img src="{{ asset('storage/' . $technology->image) }}" 
                     alt="{{ $technology->name_fr }}" 
                     class="w-32 h-32 object-cover rounded">
                <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*"
               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
               {{ isset($technology) ? '' : 'required' }}>
        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>