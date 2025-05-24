<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'number' => '101',
                'type' => 'Chambre Simple',
                'capacity' => 1,
                'price_per_night' => 89.99,
                'description' => 'Chambre confortable pour une personne avec lit simple, salle de bain privée, WiFi gratuit',
                'amenities' => json_encode(['WiFi', 'TV', 'Climatisation', 'Salle de bain privée']),
                'is_available' => true
            ],
            [
                'number' => '102',
                'type' => 'Chambre Double',
                'capacity' => 2,
                'price_per_night' => 129.99,
                'description' => 'Chambre spacieuse avec grand lit double, parfaite pour les couples',
                'amenities' => json_encode(['WiFi', 'TV', 'Climatisation', 'Salle de bain privée', 'Mini-bar']),
                'is_available' => true
            ],
            [
                'number' => '201',
                'type' => 'Suite Familiale',
                'capacity' => 4,
                'price_per_night' => 199.99,
                'description' => 'Grande suite avec deux chambres, parfaite pour les familles',
                'amenities' => json_encode(['WiFi', 'TV', 'Climatisation', 'Salle de bain privée', 'Mini-bar', 'Salon séparé', 'Vue sur la ville']),
                'is_available' => true
            ],
            [
                'number' => '301',
                'type' => 'Suite Luxe',
                'capacity' => 2,
                'price_per_night' => 299.99,
                'description' => 'Suite de luxe avec jacuzzi privé et vue panoramique',
                'amenities' => json_encode(['WiFi', 'TV', 'Climatisation', 'Salle de bain privée', 'Mini-bar', 'Jacuzzi', 'Vue panoramique', 'Service en chambre 24/7']),
                'is_available' => true
            ],
            [
                'number' => '401',
                'type' => 'Suite Présidentielle',
                'capacity' => 4,
                'price_per_night' => 499.99,
                'description' => 'Notre meilleure suite avec services premium et vue exceptionnelle',
                'amenities' => json_encode(['WiFi', 'TV', 'Climatisation', 'Salle de bain privée', 'Mini-bar', 'Jacuzzi', 'Vue panoramique', 'Service en chambre 24/7', 'Salon privé', 'Cuisine équipée']),
                'is_available' => true
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
} 