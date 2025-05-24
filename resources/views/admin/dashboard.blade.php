@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Bienvenue Admin 👋</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('admin.salles.index') }}" class="bg-black text-white p-4 rounded-lg text-center shadow hover:bg-gray-800">Salles</a>
        <a href="{{ route('admin.reservations.index') }}" class="bg-black text-white p-4 rounded-lg text-center shadow hover:bg-gray-800">Réservations</a>
        <a href="{{ route('admin.reservations.liste') }}" class="bg-black text-white p-4 rounded-lg text-center shadow hover:bg-gray-800">Liste des Réservations</a>
        <a href="{{ route('admin.classes.index') }}" class="bg-black text-white p-4 rounded-lg text-center shadow hover:bg-gray-800">Liste des Classes</a>
    </div>
</div>
@endsection
