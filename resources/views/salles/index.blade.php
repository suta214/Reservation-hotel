<x-app-layout>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des Salles</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('salles.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-black rounded">Ajouter une Salle</a>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Capacité</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salles as $salle)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $salle->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $salle->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $salle->capacity }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('salles.edit', $salle->id) }}" class="text-blue-600 hover:underline mr-2">Modifier</a>
                        <form action="{{ route('salles.destroy', $salle->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer cette salle ?')" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($salles->isEmpty())
                <tr>
                    <td colspan="4" class="text-center py-4">Aucune salle trouvée.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>


