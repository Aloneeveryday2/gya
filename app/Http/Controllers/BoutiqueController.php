<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class BoutiqueController extends Controller
{
    public function index()
    {
        $services = [
            [
                'id' => 1,
                'name' => 'Netflix Premium',
                'description' => 'Accès à Netflix en qualité 4K UHD sur 4 écrans simultanés',
                'price' => 2500,
                'image' => 'netflix (1).jpeg',
                'badge_color' => '#E50914',
                'badge_text' => 'Premium',
                'category' => 'streaming',
                'features' => [
                    'Qualité 4K UHD',
                    '4 écrans simultanés',
                    'HDR et Dolby Vision',
                    'Téléchargements illimités'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Spotify Premium',
                'description' => 'Musique sans pub, qualité supérieure, mode hors connexion',
                'price' => 2500,
                'image' => 'spotify.jpeg',
                'badge_color' => '#1DB954',
                'badge_text' => 'Popular',
                'category' => 'music',
                'features' => [
                    'Écoute hors connexion',
                    'Sans publicités',
                    'Qualité audio supérieure',
                    'Choix illimité de titres'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Disney+',
                'description' => 'Accès à tout le catalogue Disney, Marvel, Star Wars et plus',
                'price' => 4500,
                'image' => '_ (9).jpeg',
                'badge_color' => '#113CCF',
                'badge_text' => 'Nouveau',
                'category' => 'streaming',  // Added category
                'features' => [
                    'Contenu Disney exclusif',
                    'Qualité 4K HDR',
                    '4 écrans simultanés',
                    'Profils enfants'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Amazon Prime Video',
                'description' => 'Films, séries et contenus originaux Amazon en qualité 4K HDR',
                'price' => 3500,
                'image' => '_ (10).jpeg',
                'badge_color' => '#00A8E1',
                'badge_text' => 'Premium',
                'category' => 'streaming',  // Added category
                'features' => [
                    'Qualité 4K HDR',
                    'Téléchargements illimités',
                    'Prime Gaming inclus',
                    'Prime Reading inclus'
                ]
            ],
            [
                'id' => 5,
                'name' => 'Apple Music',
                'description' => 'Plus de 90 millions de titres, sans pub, haute qualité',
                'price' => 3000,
                'image' => '9to5Mac - Apple News & Mac Rumors Breaking All Day.jpeg',
                'badge_color' => '#FB233B',
                'badge_text' => 'Premium',
                'category' => 'music',  // Added category
                'features' => [
                    'Audio sans perte',
                    'Audio spatial',
                    'Paroles en temps réel',
                    'Téléchargements illimités'
                ]
                ],

            [
                'id' => 6,
                'name' => 'My Canal+',
                'description' => 'Accédez aux chaînes Canal+, beIN SPORTS, et plus de 100 chaînes en direct et à la demande',
                'price' => 5000,
                'image' => 'mycanal.jpeg',
                'badge_color' => '#000000',
                'badge_text' => 'Premium',
                'category' => 'streaming',
                'features' => [
                    'Chaînes Canal+ en direct',
                    'Événements sportifs en direct',
                    'Films et séries à la demande',
                    'Multi-écrans disponible'
                ]
            ]
        ];

        return view('boutique.index', ['services' => collect($services), 'categories' => collect($services)->pluck('category')->unique()]);
    }

    public function show($id)
    {
        $services = [
            [
                'id' => 1,
                'name' => 'Netflix Premium',
                'description' => 'Accès à Netflix en qualité 4K UHD sur 4 écrans simultanés',
                'price' => 2500,
                'image' => 'netflix (1).jpeg',
                'badge_color' => '#E50914',
                'badge_text' => 'Premium',
                'features' => [
                    'Qualité 4K UHD',
                    '4 écrans simultanés',
                    'HDR et Dolby Vision',
                    'Téléchargements illimités'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Spotify Premium',
                'description' => 'Musique sans pub, qualité supérieure, mode hors connexion',
                'price' => 2500,
                'image' => 'spotify.jpeg',
                'badge_color' => '#1DB954',
                'badge_text' => 'Popular',
                'features' => [
                    'Écoute hors connexion',
                    'Sans publicités',
                    'Qualité audio supérieure',
                    'Choix illimité de titres'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Disney+',
                'description' => 'Accès à tout le catalogue Disney, Marvel, Star Wars et plus',
                'price' => 4500,
                'image' => '_ (9).jpeg',
                'badge_color' => '#113CCF',
                'badge_text' => 'Nouveau',
                'features' => [
                    'Contenu Disney exclusif',
                    'Qualité 4K HDR',
                    '4 écrans simultanés',
                    'Profils enfants'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Amazon Prime Video',
                'description' => 'Films, séries et contenus originaux Amazon en qualité 4K HDR',
                'price' => 3500,
                'image' => '_ (10).jpeg',
                'badge_color' => '#00A8E1',
                'badge_text' => 'Premium',
                'features' => [
                    'Qualité 4K HDR',
                    'Téléchargements illimités',
                    'Prime Gaming inclus',
                    'Prime Reading inclus'
                ]
            ],
            [
                'id' => 5,
                'name' => 'Apple Music',
                'description' => 'Plus de 90 millions de titres, sans pub, haute qualité',
                'price' => 3000,
                'image' => '9to5Mac - Apple News & Mac Rumors Breaking All Day.jpeg',
                'badge_color' => '#FB233B',
                'badge_text' => 'Premium',
                'features' => [
                    'Audio sans perte',
                    'Audio spatial',
                    'Paroles en temps réel',
                    'Téléchargements illimités'
                ]
                ],

            [
                'id' => 6,
                'name' => 'My Canal+',
                'description' => 'Accédez aux chaînes Canal+, beIN SPORTS, et plus de 100 chaînes en direct et à la demande',
                'price' => 5000,
                'image' => 'mycanal.jpeg',
                'badge_color' => '#000000',
                'badge_text' => 'Premium',
                'category' => 'streaming',
                'features' => [
                    'Chaînes Canal+ en direct',
                    'Événements sportifs en direct',
                    'Films et séries à la demande',
                    'Multi-écrans disponible'
                ]
            ]
        ];

        $service = collect($services)->firstWhere('id', (int)$id);

        if (!$service) {
            abort(404);
        }

        return view('boutique.show', ['service' => $service]);
    }
}
