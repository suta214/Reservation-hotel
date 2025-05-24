<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réserver une chambre') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                        alt="Luxury Hotel" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
                </div>
                <div class="relative px-8 py-32 text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Une expérience inoubliable
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-200">
                        Découvrez le luxe et le confort dans nos chambres soigneusement aménagées
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <!-- Dates de séjour -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative">
                                <label for="check_in_date" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" name="check_in_date" id="check_in_date" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div class="relative">
                                <label for="check_out_date" class="block text-sm font-medium text-gray-700">Date de départ</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" name="check_out_date" id="check_out_date" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Nombre de personnes -->
                        <div class="relative">
                            <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Nombre de personnes</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <input type="number" name="number_of_guests" id="number_of_guests" min="1" required
                                    class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Sélection de la chambre -->
                        <div class="space-y-6">
                            <h3 class="text-2xl font-bold text-gray-900">Choisissez votre chambre</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($rooms as $room)
                                <div class="relative group" x-data="{ isSelected: false }">
                                    <input type="radio" name="room_id" id="room_{{ $room->id }}" value="{{ $room->id }}"
                                        class="peer absolute opacity-0" x-on:change="isSelected = $event.target.checked">
                                    <label for="room_{{ $room->id }}"
                                        class="block rounded-xl overflow-hidden cursor-pointer transform transition-all duration-300
                                        peer-checked:ring-4 peer-checked:ring-blue-500 peer-checked:scale-[1.02] hover:scale-[1.01]"
                                        :class="{ 'ring-4 ring-blue-500 scale-[1.02]': isSelected }">
                                        <div class="relative">
                                            <img src="{{ $room->type === 'Suite Présidentielle' ? 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-1.2.1' : 
                                                ($room->type === 'Suite Luxe' ? 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1' : 
                                                ($room->type === 'Suite Familiale' ? 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-1.2.1' :
                                                ($room->type === 'Suite Junior' ? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1' : 
                                                'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-1.2.1'))) }}"
                                                alt="{{ $room->type }}" class="w-full h-48 object-cover">

                                            <div class="p-4">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div>
                                                        <h4 class="text-lg font-semibold">{{ $room->type }}</h4>
                                                        <p class="text-sm text-gray-600 mt-1">{{ $room->description }}</p>
                                                    </div>
                                                    <div class="flex items-baseline space-x-1 ml-4">
                                                        <span class="text-2xl font-bold text-blue-600">{{ number_format($room->price_per_night) }}€</span>
                                                        <span class="text-sm text-gray-500">par nuit</span>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-4 mt-4 text-sm text-gray-500">
                                                    <div class="flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        Max {{ $room->capacity }} pers.
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                        {{ $room->size ?? '25' }} m²
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Badge de sélection -->
                                            <div x-show="isSelected" 
                                                class="absolute top-4 right-4 bg-blue-500 text-white rounded-full p-2 transform scale-110 animate-bounce">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="p-4 bg-white border-t border-gray-100">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-baseline space-x-1">
                                                    <span class="text-2xl font-bold text-blue-600">{{ number_format($room->price_per_night) }}€</span>
                                                    <span class="text-sm text-gray-500">par nuit</span>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-4">{{ $room->description }}</p>
                                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    Max {{ $room->capacity }} pers.
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    {{ $room->size ?? '25' }} m²
                                                </div>
                                            </div>
                                            <!-- Bouton de sélection -->
                                            <button type="button" 
                                                class="mt-4 w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white transition-colors duration-200"
                                                :class="isSelected ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700'"
                                                x-text="isSelected ? 'Sélectionnée' : 'Sélectionner'"
                                                @click="$refs.roomInput_{{ $room->id }}.click()">
                                            </button>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Récapitulatif de la réservation -->
                        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4" x-data="{ showRecap: false }" x-show="showRecap">
                            <h4 class="text-lg font-semibold text-gray-900">Récapitulatif de votre réservation</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Chambre sélectionnée</span>
                                    <span class="font-medium text-gray-900" x-text="selectedRoomName"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Dates du séjour</span>
                                    <span class="font-medium text-gray-900" x-text="formattedDates"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nombre de nuits</span>
                                    <span class="font-medium text-gray-900" x-text="numberOfNights + ' nuit(s)'"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nombre de personnes</span>
                                    <span class="font-medium text-gray-900" x-text="numberOfGuests + ' personne(s)'"></span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span class="text-2xl font-bold text-blue-600" x-text="totalPrice + '€'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Demandes spéciales -->
                        <div class="relative">
                            <label for="special_requests" class="block text-sm font-medium text-gray-700">Demandes spéciales</label>
                            <div class="mt-1">
                                <textarea name="special_requests" id="special_requests" rows="4"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Avez-vous des demandes particulières pour votre séjour ?"></textarea>
                            </div>
                        </div>

                        <!-- Prix total estimé -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900">Prix total estimé</h4>
                                    <p class="text-sm text-gray-500">Pour la durée de votre séjour</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-blue-600" id="totalPrice">--</div>
                                    <div class="text-sm text-gray-500" id="nightsCount"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de confirmation -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" @click="window.history.back()"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Annuler
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-semibold rounded-xl shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-300 hover:scale-105"
                                x-bind:disabled="!isFormValid"
                                x-bind:class="{ 'opacity-50 cursor-not-allowed': !isFormValid }">
                                Confirmer la réservation
                                <svg class="ml-3 -mr-1 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInDate = document.getElementById('check_in_date');
        const checkOutDate = document.getElementById('check_out_date');
        const roomInputs = document.querySelectorAll('input[name="room_id"]');
        const totalPriceElement = document.getElementById('totalPrice');
        const nightsCountElement = document.getElementById('nightsCount');
        const guestsInput = document.getElementById('number_of_guests');

        function updateTotalPrice() {
            const selectedRoom = document.querySelector('input[name="room_id"]:checked');
            if (!selectedRoom || !checkInDate.value || !checkOutDate.value) {
                totalPriceElement.textContent = '--';
                nightsCountElement.textContent = '';
                return;
            }

            const start = new Date(checkInDate.value);
            const end = new Date(checkOutDate.value);
            const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            if (nights <= 0) {
                totalPriceElement.textContent = '--';
                nightsCountElement.textContent = '';
                return;
            }

            const pricePerNight = parseFloat(selectedRoom.closest('.relative').querySelector('.text-2xl').textContent);
            const totalPrice = nights * pricePerNight;
            totalPriceElement.textContent = `${totalPrice}€`;
            nightsCountElement.textContent = `${nights} nuit${nights > 1 ? 's' : ''}`;

            // Mettre à jour le récapitulatif
            updateRecap(selectedRoom, start, end, nights, totalPrice);
        }

        function updateRecap(selectedRoom, start, end, nights, totalPrice) {
            const recap = {
                selectedRoomName: selectedRoom.closest('.relative').querySelector('h4').textContent,
                formattedDates: `${start.toLocaleDateString()} - ${end.toLocaleDateString()}`,
                numberOfNights: nights,
                numberOfGuests: guestsInput.value,
                totalPrice: totalPrice
            };

            // Mettre à jour l'interface avec Alpine.js
            window.dispatchEvent(new CustomEvent('update-recap', { detail: recap }));
        }

        function validateForm() {
            const isValid = checkInDate.value && 
                          checkOutDate.value && 
                          document.querySelector('input[name="room_id"]:checked') &&
                          guestsInput.value > 0;

            // Mettre à jour l'état du bouton avec Alpine.js
            window.dispatchEvent(new CustomEvent('form-validation', { detail: { isValid } }));
        }

        checkInDate.addEventListener('change', () => {
            updateTotalPrice();
            validateForm();
        });
        checkOutDate.addEventListener('change', () => {
            updateTotalPrice();
            validateForm();
        });
        roomInputs.forEach(input => {
            input.addEventListener('change', () => {
                updateTotalPrice();
                validateForm();
            });
        });
        guestsInput.addEventListener('change', () => {
            updateTotalPrice();
            validateForm();
        });

        // Animation des cartes au survol
        const roomCards = document.querySelectorAll('.relative.group');
        roomCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                if (!card.querySelector('input[name="room_id"]').checked) {
                    card.classList.add('transform', 'scale-[1.01]');
                }
            });
            card.addEventListener('mouseleave', () => {
                if (!card.querySelector('input[name="room_id"]').checked) {
                    card.classList.remove('transform', 'scale-[1.01]');
                }
            });
        });
    });
    </script>
    @endpush
</x-app-layout>
