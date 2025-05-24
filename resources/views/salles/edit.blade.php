<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier la Salle</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('salles.update', $salle->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nom de la salle :</label>
                <input type="text" name="name" id="name" value="{{ old('name', $salle->name) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 font-bold mb-2">Capacité :</label>
                <input type="number" name="capacity" id="capacity" min="1" value="{{ old('capacity', $salle->capacity) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('capacity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description :</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $salle->description) }}</textarea>
            </div>

            <button type="submit"
                class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">Mettre à jour</button>
            <a href="{{ route('salles.index') }}"
                class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </form>
    </div>
</x-app-layout>
