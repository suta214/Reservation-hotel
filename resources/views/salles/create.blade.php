<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-black leading-tight">Ajouter une Salle</h2>
</x-slot>
    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('salles.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nom de la salle :</label>
                <input type="text" name="name" id="name" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 font-bold mb-2">Capacité :</label>
                <input type="number" name="capacity" id="capacity" min="1" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('capacity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description :</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit"
                class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">Enregistrer</button>
            <a href="{{ route('salles.index') }}"
                class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </form>
    </div>
</x-app-layout>
