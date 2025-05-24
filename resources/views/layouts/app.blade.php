<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles supplémentaires -->
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-8">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-gray-300 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">À propos</h3>
                            <p class="text-gray-400">
                                Notre hôtel de luxe vous offre une expérience unique avec un service personnalisé et des installations haut de gamme.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Contact</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li>123 Rue de l'Hôtel</li>
                                <li>75000 Paris</li>
                                <li>Tél : 01 23 45 67 89</li>
                                <li>Email : contact@hotel-luxe.com</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Liens rapides</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a></li>
                                <li><a href="{{ route('reservations.create') }}" class="hover:text-white">Réserver</a></li>
                                <li><a href="{{ route('reservations.index') }}" class="hover:text-white">Mes réservations</a></li>
                                <li><a href="{{ route('profile.edit') }}" class="hover:text-white">Mon profil</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                        <p>&copy; {{ date('Y') }} Hôtel de Luxe. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
