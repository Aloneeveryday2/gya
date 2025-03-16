<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetYourAccounts225 - Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        * {
            font-family: 'Montserrat', sans-serif;
        }
        .loader {
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 3px solid #ef4444;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <header x-data="{ isOpen: false }" class="fixed w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-red-600 text-2xl mr-2"></i>
                    <span class="text-xl font-bold bg-gradient-to-r from-red-600 to-red-800 text-transparent bg-clip-text">GetYourAccounts225</span>
                </div>
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ url("/Accueil") }}" class="text-gray-600 hover:text-blue-600 transition-colors">Accueil</a>
                    <a href="#offres" class="text-gray-600 hover:text-blue-600 transition-colors">Offres</a>
                    <a href="#faq" class="text-gray-600 hover:text-blue-600 transition-colors">FAQ</a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Mon compte</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Se connecter</a>
                        <a href="{{ route('register') }}" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition-colors">S'inscrire</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <div class="pt-24 pb-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bouton retour -->
            <div class="mb-6">
                <a href="{{ url('/Accueil') }}" class="inline-flex items-center text-gray-600 hover:text-red-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à l'accueil
                </a>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Notre Boutique</h1>

            <!-- Filtres -->
            <div x-data="{
                activeFilter: 'all',
                isLoading: false,
                filterItems(category) {
                    this.isLoading = true;
                    this.activeFilter = category;
                    setTimeout(() => {
                        this.isLoading = false;
                    }, 500);
                }
            }" class="mb-8">
                <!-- Filtres responsive -->
                <div class="flex flex-wrap justify-center gap-2 sm:gap-4">
                    <button @click="filterItems('all')"
                            :class="{ 'bg-red-600 text-white': activeFilter === 'all', 'bg-white text-gray-700': activeFilter !== 'all' }"
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base rounded-full shadow-sm hover:bg-red-700 hover:text-white transition-colors">
                        Tous
                    </button>
                    <button @click="filterItems('streaming')"
                            :class="{ 'bg-red-600 text-white': activeFilter === 'streaming', 'bg-white text-gray-700': activeFilter !== 'streaming' }"
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base rounded-full shadow-sm hover:bg-red-700 hover:text-white transition-colors">
                        Streaming
                    </button>
                    <button @click="filterItems('music')"
                            :class="{ 'bg-red-600 text-white': activeFilter === 'music', 'bg-white text-gray-700': activeFilter !== 'music' }"
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base rounded-full shadow-sm hover:bg-red-700 hover:text-white transition-colors">
                        Musique
                    </button>
                    <button @click="filterItems('gaming')"
                            :class="{ 'bg-red-600 text-white': activeFilter === 'gaming', 'bg-white text-gray-700': activeFilter !== 'gaming' }"
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base rounded-full shadow-sm hover:bg-red-700 hover:text-white transition-colors">
                        Gaming
                    </button>
                </div>

                <!-- Loading indicator -->
                <div x-show="isLoading" class="flex justify-center items-center my-6 sm:my-8">
                    <div class="loader"></div>
                </div>

                <!-- Grille des produits -->
                <div x-show="!isLoading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    @foreach($services as $service)
                    <div x-cloak
                         x-show="activeFilter === 'all' || activeFilter === '{{ $service['category'] }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $service['image']) }}" alt="{{ $service['name'] }}" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full" style="background-color: {{ $service['badge_color'] }}">
                                {{ $service['badge_text'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $service['name'] }}</h2>
                        <p class="text-gray-600 mb-4">{{ $service['description'] }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-800">{{ number_format($service['price'], 0, ',', ' ') }}</span>
                                <span class="text-gray-600">FCFA/mois</span>
                            </div>
                            <a href="{{ route('boutique.show', $service['id']) }}" class="inline-flex items-center px-4 py-2 text-white rounded-full transition-colors"
                               style="background-color: {{ $service['badge_color'] }}; hover:opacity-90">
                                <span>Voir détails</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Ajout du footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12">
                <div>
                    <h4 class="text-lg font-semibold mb-4">À propos</h4>
                    <p class="text-gray-400">GetYourAccounts225, votre partenaire de confiance pour des abonnements premium à prix réduits.</p>
                </div>
                <div>
                    <!-- Dans le footer, mettre à jour les liens -->
                    <ul class="space-y-2">
                        <li><a href="{{ url("/Accueil") }}" class="text-gray-400 hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="#offres" class="text-gray-400 hover:text-white transition-colors">Offres</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fab fa-whatsapp mr-2"></i>+225 07 17 04 79 39</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i>contact@getyouraccounts225.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/getyouraccounts225?igsh=MWRqNmJjYTQxbXZyOA%3D%3D&utm_source=qr" class="hover:text-pink-400 transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 GetYourAccounts225. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>


