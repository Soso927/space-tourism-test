{{-- resources/views/crew/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Modifier un membre d’équipage — Admin' }}
        </h2>
    </x-slot>

    {{-- La variable passée à cette vue doit être nommée $crewMember --}}
    <section class="max-w-3xl mx-auto px-6 py-8">

        {{-- Titre + retour --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Modifier : {{ $crewMember->name }}</h1>
            <a href="{{ route('admin.crew.index') }}" class="underline">Retour à la liste</a>
        </div>

        {{-- Erreurs globales --}}
        @if ($errors->any())
            <div class="mb-4 rounded border border-red-500/40 bg-red-500/10 text-red-200 px-4 py-3">
                <p class="font-medium mb-1">Veuillez corriger les erreurs suivantes :</p>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('admin.crew.update', $crewMember) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nom complet (FR) --}}
            <div>
                <label for="name_fr" class="block text-sm font-medium mb-1">Nom complet</label>
                <input type="text" id="name_fr" name="name_fr"
                    value="{{ old('name', $crewMember->name) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : Douglas Hurley" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Full Name (EN) --}}
            <div>
                <label for="name_en" class="block text-sm font-medium mb-1">Full Name (EN)</label>
                <input type="text" id="name_en" name="name_en"
                    value="{{ old('name_en', $crewMember->name_en) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="e.g.: Douglas Hurley" required>
                @error('name_en')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rôle (FR) --}}
            <div>
                <label for="role_fr" class="block text-sm font-medium mb-1">Rôle (ex: Commander, Pilot)</label>
                <input type="text" id="role_fr" name="role_fr"
                    value="{{ old('role', $crewMember->role) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : Commander" required>
                @error('role')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role (EN) --}}
            <div>
                <label for="role_en" class="block text-sm font-medium mb-1">Role (EN)</label>
                <input type="text" id="role_en" name="role_en"
                    value="{{ old('role_en', $crewMember->role_en) }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="e.g.: Commander" required>
                @error('role_en')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Biographie (FR) --}}
            <div>
                <label for="bio" class="block text-sm font-medium mb-1">Biographie</label>
                <textarea id="bio" name="bio" rows="5"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Brève biographie du membre d'équipage…" required>{{ old('bio', $crewMember->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Biography (EN) --}}
            <div>
                <label for="bio_en" class="block text-sm font-medium mb-1">Biography (EN)</label>
                <textarea id="bio_en" name="bio_en" rows="5"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Short biography…" required>{{ old('bio_en', $crewMember->bio_en) }}</textarea>
                @error('bio_en')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-medium mb-1">
                    Image (laisser vide pour ne pas changer)
                </label>

                {{-- Image actuelle --}}
                @php
                    $currentImage = $crewMember->image ?? null;
                @endphp

                @if ($currentImage)
                    <div class="mb-3">
                        <p class="text-sm opacity-80 mb-2">Image actuelle :</p>
                        <img src="{{ asset('storage/' . $currentImage) }}"
                             alt="Image actuelle de {{ $crewMember->name }}"
                             class="max-h-40 rounded border border-white/10">
                    </div>
                @endif

                <input type="file" id="image" name="image" accept="image/*"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2">
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror

                {{-- Aperçu si nouvelle image --}}
                <div id="previewContainer" class="mt-3 hidden">
                    <p class="text-sm opacity-80 mb-2">Aperçu de la nouvelle image :</p>
                    <img id="previewImage" src="" alt="Prévisualisation"
                        class="max-h-40 rounded border border-white/10">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Mettre à jour
                </button>
            </div>
        </form>
    </section>

    {{-- Script pour la prévisualisation --}}
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
                        previe
