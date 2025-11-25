{{-- resources/views/crew/index.blade.php --}}
<x-app-layout>
    {{-- En-tête du layout Breeze --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Équipage — Back-office
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Action principale : Créer un membre --}}
            <a href="{{ route('admin.crew.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Ajouter un membre d’équipage
            </a>

            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                @if($crewMembers->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2 px-2">Nom (FR)</th>
                                    <th class="text-left py-2 px-2">Nom (EN)</th>

                                    <th class="text-left py-2 px-2">Rôle (FR)</th>
                                    <th class="text-left py-2 px-2">Role (EN)</th>

                                    <th class="text-left py-2 px-2">Bio FR (Extrait)</th>
                                    <th class="text-left py-2 px-2">Bio EN (Extrait)</th>

                                    <th class="text-left py-2 px-2 w-40">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($crewMembers as $crewMember)
                                    <tr class="border-b">
                                        {{-- Nom FR et EN --}}
                                        <td class="py-2 px-2 font-medium">{{ $crewMember->name }}</td>
                                        <td class="py-2 px-2 text-gray-600">{{ $crewMember->name_en }}</td>

                                        {{-- Rôle FR et EN --}}
                                        <td class="py-2 px-2">{{ $crewMember->role }}</td>
                                        <td class="py-2 px-2 text-gray-600">{{ $crewMember->role_en }}</td>

                                        {{-- Bio FR + EN (extraits) --}}
                                        <td class="py-2 px-2 text-gray-600">
                                            {{ \Illuminate\Support\Str::limit($crewMember->bio, 50) }}
                                        </td>
                                        <td class="py-2 px-2 text-gray-600">
                                            {{ \Illuminate\Support\Str::limit($crewMember->bio_en, 50) }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="py-2 px-2">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.crew.edit', $crewMember) }}"
                                                   class="text-blue-600 hover:underline">Modifier</a>

                                                <form method="POST"
                                                      action="{{ route('admin.crew.destroy', $crewMember) }}"
                                                      onsubmit="return confirm('Supprimer ce membre d’équipage ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $crewMembers->links() }}
                    </div>

                @else
                    {{-- Aucun membre --}}
                    <p class="text-gray-600">Aucun membre d’équipage pour le moment.</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.crew.create') }}"
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Ajouter le premier membre d’équipage
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
