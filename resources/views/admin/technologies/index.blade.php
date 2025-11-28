<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Technologies
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-semibold">Liste des technologies</h3>
                        <a href="{{ route('admin.technologies.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter une technologie
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full bg-white shadow-md rounded">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Image</th>
                                <th class="px-4 py-2 text-left">Nom (FR)</th>
                                <th class="px-4 py-2 text-left">Nom (EN)</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($technologies as $technology)
                                <tr class="border-b">
                                    <td class="px-4 py-2">
                                        @if($technology->image)
                                            <img src="{{ asset('storage/' . $technology->image) }}" 
                                                 alt="{{ $technology->name_fr }}" 
                                                 class="w-16 h-16 object-cover rounded">
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $technology->name_fr }}</td>
                                    <td class="px-4 py-2">{{ $technology->name_en }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.technologies.edit', $technology) }}" 
                                           class="text-blue-600 hover:underline">Modifier</a>
                                        <form action="{{ route('admin.technologies.destroy', $technology) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline ml-2">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        Aucune technologie pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $technologies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>