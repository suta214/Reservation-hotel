<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la réservation') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bouton retour -->
            <div class="mb-8">
                <a href="{{ route('reservations.index') }}" 
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour aux réservations
                </a>
            </div>

            <!-- Carte principale -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- En-tête avec image -->
                <div class="relative h-64">
                    <img src="{{ $reservation->room->type === 'Suite Présidentielle' ? 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-1.2.1' : 
                        ($reservation->room->type === 'Suite Luxe' ? 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1' : 
                        ($reservation->room->type === 'Suite Familiale' ? 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-1.2.1' :
                        ($reservation->room->type === 'Suite Junior' ? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1' : 
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-1.2.1'))) }}"
                        alt="{{ $reservation->room->type }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h1 class="text-3xl font-bold text-white">{{ $reservation->room->name }}</h1>
                        <p class="text-lg text-gray-200">{{ $reservation->room->type }}</p>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="p-8">
                    <!-- Statut -->
                    <div class="mb-8">
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full 
                            @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>

                    <!-- Informations principales -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Détails du séjour</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Check-in</p>
                                        <p class="text-base text-gray-900">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Check-out</p>
                                        <p class="text-base text-gray-900">{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Durée du séjour</p>
                                        <p class="text-base text-gray-900">{{ \Carbon\Carbon::parse($reservation->check_in_date)->diffInDays($reservation->check_out_date) }} nuits</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations complémentaires</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nombre de personnes</p>
                                        <p class="text-base text-gray-900">{{ $reservation->number_of_guests }} personne(s)</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Type de chambre</p>
                                        <p class="text-base text-gray-900">{{ $reservation->room->type }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Prix total</p>
                                        <p class="text-base text-gray-900">{{ number_format($reservation->total_price, 2) }}€</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Demandes spéciales -->
                    @if($reservation->special_requests)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Demandes spéciales</h3>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-gray-700">{{ $reservation->special_requests }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4">
                        @if($reservation->status === 'pending')
                        <form action="{{ route('reservations.confirm', $reservation) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-base font-medium rounded-xl shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-all duration-300 hover:scale-105"
                                onclick="return confirm('Voulez-vous confirmer cette réservation ?')">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Confirmer la réservation
                            </button>
                        </form>
                        @endif

                        @if($reservation->status !== 'cancelled')
                        <form action="{{ route('reservations.cancel', $reservation) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-base font-medium rounded-xl shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform transition-all duration-300 hover:scale-105"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Annuler la réservation
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 