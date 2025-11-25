<x-app-layout>

    <div class="grid grid-cols-1 gap-4">

        <form action="{{ route('admin.crew.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Nom complet (FR) --}}
            <div>
                <label class="block text-sm font-medium">Nom complet</label>
                <input class="mt-1 w-full border rounded-md p-2" 
                       type="text" name="name_fr"
                       value="{{ old('name_fr', $crewMember->name ?? '') }}" required>
                @error('name_fr')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Full Name (EN) --}}
            <div>
                <label class="block text-sm font-medium">Full Name (EN)</label>
                <input class="mt-1 w-full border rounded-md p-2"
                       type="text" name="name_en"
                       value="{{ old('name_en', $crewMember->name_en ?? '') }}" required>
                @error('name_en')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Rôle (FR) --}}
            <div>
                <label class="block text-sm font-medium">Rôle (ex: Commander, Pilot)</label>
                <input class="mt-1 w-full border rounded-md p-2" 
                       type="text" name="role_fr"
                       value="{{ old('role_fr', $crewMember->role ?? '') }}" required>
                @error('role_fr')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role (EN) --}}
            <div>
                <label class="block text-sm font-medium">Role (EN)</label>
                <input class="mt-1 w-full border rounded-md p-2"
                       type="text" name="role_en"
                       value="{{ old('role_en', $crewMember->role_en ?? '') }}" required>
                @error('role_en')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Biographie (FR) --}}
            <div>
                <label class="block text-sm font-medium">Biographie</label>
                <textarea class="mt-1 w-full border rounded-md p-2"
                          name="bio_fr" rows="6" required>{{ old('bio_fr', $crewMember->bio ?? '') }}</textarea>
                @error('bio_fr')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Biography (EN) --}}
            <div>
                <label class="block text-sm font-medium">Biography (EN)</label>
                <textarea class="mt-1 w-full border rounded-md p-2"
                          name="bio_en" rows="6" required>{{ old('bio_en', $crewMember->bio_en ?? '') }}</textarea>
                @error('bio_en')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-medium">Image (portrait)</label>
                <input class="mt-1 w-full" type="file" name="image">
                @error('image')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror

                {{-- Image actuelle en mode édition --}}
                @if (!empty($crewMember?->image))
                    <div class="mt-2">
                        <p class="text-xs text-gray-500 mb-1">Image actuelle :</p>
                        <img src="{{ asset('storage/' . $crewMember->image) }}"
                             alt="{{ $crewMember->name ?? 'Image actuelle' }}"
                             class="h-24 rounded object-cover">
                    </div>
                @endif
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Enregistrer
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
