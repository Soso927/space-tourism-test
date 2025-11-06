{{-- resources/views/admin/planets/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Modifier une planète — Admin" }}
        </h2>
    </x-slot>

    <section class="max-w-3xl mx-auto px-6 py-8">
        {{-- Titre + retour --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Modifier une planète</h1>
            <a href="{{ route('admin.planets.index') }}" class="underline">Retour à la liste</a>
        </div>

        {{-- Erreurs globales --}}
        @if($errors->any())
            <div class="mb-4 rounded border border-red-500/40 bg-red-500/10 text-red-200 px-4 py-3">
                <p class="font-medium mb-1">Veuillez corriger les erreurs suivantes :</p>
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.planets.update', $planet) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- name_fr --}}
            <div>
                <label for="name_fr" class="block text-sm font-medium mb-1">Nom (FR)</label>
                <input
                    type="text"
                    id="name_fr"
                    name="name_fr"
                    value="{{ old('name_fr', $planet->name_fr) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : Europe"
                    required
                >
                @error('name_fr')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- name_en --}}
            <div>
                <label for="name_en" class="block text-sm font-medium mb-1">Name (EN)</label>
                <input
                    type="text"
                    id="name_en"
                    name="name_en"
                    value="{{ old('name_en', $planet->name_en) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="e.g. Europa"
                    required
                >
                @error('name_en')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- description_fr --}}
            <div>
                <label for="description_fr" class="block text-sm font-medium mb-1">Description (FR)</label>
                <textarea
                    id="description_fr"
                    name="description_fr"
                    rows="5"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Brève description en français…"
                    required>{{ old('description_fr', $planet->description_fr) }}</textarea>
                @error('description_fr')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- description_en --}}
            <div>
                <label for="description_en" class="block text-sm font-medium mb-1">Description (EN)</label>
                <textarea
                    id="description_en"
                    name="description_en"
                    rows="5"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Short description in English…"
                    required>{{ old('description_en', $planet->description_en) }}</textarea>
                @error('description_en')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- distance --}}
            <div>
                <label for="distance" class="block text-sm font-medium mb-1">Distance (en km)</label>
                <input
                    type="text"
                    step="0.01"
                    id="distance"
                    name="distance"
                    value="{{ old('distance', $planet->distance) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : 628300000"
                    required
                >
                @error('distance')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- duration --}}
            <div>
                <label for="duration" class="block text-sm font-medium mb-1">Durée du voyage (en mois)</label>
                <input
                    type="text"
                    step="1"
                    min="0"
                    id="duration"
                    name="duration"
                    value="{{ old('duration', $planet->duration) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : 6"
                    required
                >
                @error('duration')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- image --}}
            <div>
                <label for="image" class="block text-sm font-medium mb-1">Image</label>

                {{-- Image actuelle (si présente) --}}
                @php
                    $currentImage = $planet->image_path ?? $planet->image ?? null;
                @endphp

                @if($currentImage)
                    <div class="mb-3">
                        <p class="text-sm opacity-80 mb-2">Image actuelle :</p>
                        <img
                            src="{{ asset('storage/' . $currentImage) }}"
                            alt="Image actuelle de {{ $planet->name_fr ?? $planet->name_en }}"
                            class="max-h-40 rounded border border-white/10"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                >
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror

                {{-- Aperçu (si on choisit un nouveau fichier) --}}
                <div id="previewContainer" class="mt-3 hidden">
                    <p class="text-sm opacity-80 mb-2">Aperçu de la nouvelle image :</p>
                    <img id="previewImage" src="" alt="Prévisualisation" class="max-h-40 rounded border border-white/10">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Mettre à jour
                </button>
            </div>
        </form>
    </section>

    {{-- Aperçu image (même logique que la création) --}}
    <script>
        const fileInput = document.getElementById('image');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');

        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                const [file] = e.target.files || [];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = ({ target }) => {
                        previewImage.src = target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = '';
                    previewContainer.classList.add('hidden');
                }
            });
        }
    </script>
</x-app-layout>
