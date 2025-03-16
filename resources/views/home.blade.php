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

</head>
<style>
    * {
        font-family: 'Montserrat', sans-serif;
    }
</style>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header avec menu mobile fonctionnel -->
    <!-- Header avec menu mobile -->
    <header x-data="{ isOpen: false }" class="fixed w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-red-600 text-xl sm:text-2xl mr-2"></i>
                    <span class="text-lg sm:text-xl font-bold bg-gradient-to-r from-red-600 to-red-800 text-transparent bg-clip-text">GetYourAccounts225</span>
                </div>

                <!-- Menu mobile -->
                <button @click="isOpen = !isOpen" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Menu desktop -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ url("/Accueil") }}" class="text-gray-600 hover:text-blue-600 transition-colors">Accueil</a>
                    <a href="#offres" class="text-gray-600 hover:text-blue-600 transition-colors">Offres</a>
                    <a href="#faq" class="text-gray-600 hover:text-blue-600 transition-colors">FAQ</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Se connecter</a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition-colors text-center">S'inscrire</a>
                </nav>
            </div>

            <!-- Menu mobile dropdown -->
            <div x-show="isOpen" class="md:hidden mt-4">
                <nav class="flex flex-col space-y-4">
                    <a href="{{ url("/Accueil") }}" class="text-gray-600 hover:text-blue-600 transition-colors">Accueil</a>
                    <a href="#offres" class="text-gray-600 hover:text-blue-600 transition-colors">Offres</a>
                    <a href="#faq" class="text-gray-600 hover:text-blue-600 transition-colors">FAQ</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Se connecter</a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition-colors text-center">S'inscrire</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section responsive -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-red-600 via-red-700 to-gray-900">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="text-white text-center md:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight mb-6">Vos services premium à prix réduits</h1>
                    <p class="text-lg sm:text-xl opacity-90 mb-8">Accédez à vos plateformes préférées pour une fraction du prix habituel.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                        <a href="{{url("/boutique")}}" class="border-2 border-white text-white px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition-colors text-center">
                            Boutique
                        </a>
                        <a href="{{url("/register")}}" class="bg-white text-red-600 px-6 sm:px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors text-center">
                            Partager mon Abonnement
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm">
                            <i class="fab fa-netflix text-4xl text-red-500 mb-4"></i>
                            <h3 class="text-white font-semibold">Netflix Premium</h3>
                        </div>
                        <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm mt-8">
                            <i class="fab fa-spotify text-4xl text-green-500 mb-4"></i>
                            <h3 class="text-white font-semibold">Spotify Premium</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Recommandé pour vous -->
    <section class="py-12 sm:py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-8 sm:mb-16">Recommandé pour vous</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8 bg-gray-800 p-4 sm:p-5 rounded-xl">
                <!-- Netflix -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/netflix (1).jpeg') }}" alt="Netflix Premium" class="w-full h-24 sm:h-32 object-cover rounded-lg mb-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Netflix Premium</h3>
                    <p class="text-sm sm:text-base text-red-600 font-medium">2 500 FCFA/mois</p>
                </div>

                <!-- Spotify -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/spotify.jpeg') }}" alt="Spotify Premium" class="w-full h-24 sm:h-32 object-cover rounded-lg mb-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Spotify Premium</h3>
                    <p class="text-sm sm:text-base text-green-600 font-medium">3 000 FCFA/mois</p>
                </div>

                <!-- Disney+ -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/_ (9).jpeg') }}" alt="Disney+" class="w-full h-24 sm:h-32 object-cover rounded-lg mb-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Disney+</h3>
                    <p class="text-sm sm:text-base text-blue-600 font-medium">3 500 FCFA/mois</p>
                </div>

                <!-- Apple Music -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/9to5Mac - Apple News & Mac Rumors Breaking All Day.jpeg') }}" alt="Apple Music" class="w-full h-24 sm:h-32 object-cover rounded-lg mb-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Apple Music</h3>
                    <p class="text-sm sm:text-base text-gray-800 font-medium">3 000 FCFA/mois</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section À propos -->
{{--     <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Qui sommes-nous -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Qui sommes-nous ?</h3>
                    <div class="relative">
                        <p class="text-gray-300" :class="{ 'line-clamp-3': !expanded }">
                            GetYourAccounts225 est votre guichet unique pour accéder à une multitude d'abonnements numériques de premier ordre, offrant une expérience de divertissement complète à portée de clic. Notre plateforme conviviale vous permet d'explorer et d'acheter facilement des abonnements à des services populaires tels que Netflix, Spotify, Prime Video, Disney+, IPTV, et bien plus encore.
                        </p>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>

                <!-- Pourquoi nous choisir -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Pourquoi nous choisir ?</h3>
                    <div class="relative">
                        <p class="text-gray-300" :class="{ 'line-clamp-3': !expanded }">
                            En choisissant GetYourAccounts225, vous bénéficiez non seulement d'un accès à une variété de contenus de qualité, mais également d'une expérience client exceptionnelle. Notre équipe est disponible 24h/24 et 7j/7 pour répondre à vos questions, vous guider dans vos choix et résoudre tout problème éventuel.
                        </p>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>

                <!-- Nos tarifs -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Nos tarifs</h3>
                    <div class="relative">
                        <div :class="{ 'line-clamp-3': !expanded }">
                            <p class="text-gray-300">
                                Nous nous engageons à vous offrir des tarifs compétitifs et des promotions attractives, vous permettant de profiter de vos abonnements préférés tout en maîtrisant votre budget. De plus, notre plateforme sécurisée garantit que vos informations personnelles sont protégées à chaque étape de votre transaction.
                            </p>
                        </div>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
 --}}
    <!-- Section Avantages -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-16">Pourquoi nous choisir ?</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Carte existante -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Sécurité garantie</h3>
                    <p class="text-gray-600">Vos transactions sont 100% sécurisées et vos données sont protégées.</p>
                </div>

                <!-- Nouvelle carte Prix -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-tags text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Prix imbattables</h3>
                    <p class="text-gray-600">Les meilleurs tarifs du marché avec des réductions allant jusqu'à 80%.</p>
                </div>

                <!-- Nouvelle carte Support -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Support 24/7</h3>
                    <p class="text-gray-600">Une équipe disponible en permanence pour vous accompagner.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Offres avec toutes les cartes -->
    <section id="offres" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-16">Nos meilleures offres</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Carte Netflix -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gradient-to-r from-red-600 to-red-400 p-6 text-white">
                        <h3 class="text-2xl font-bold">Netflix Premium</h3>
                        <p class="opacity-90">Accès illimité en 4K</p>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-gray-800 mb-4">2 500 FCFA<span class="text-sm text-gray-500">/mois</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>4 écrans simultanés</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Qualité Ultra HD</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Support 24/7</li>
                        </ul>
                        <a href="#" class="block text-center bg-red-600 text-white py-3 rounded-xl hover:bg-red-700 transition-colors">
                            Choisir cette offre
                        </a>
                    </div>
                </div>

                <!-- Nouvelle carte Spotify -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gradient-to-r from-green-600 to-green-400 p-6 text-white">
                        <h3 class="text-2xl font-bold">Spotify Premium</h3>
                        <p class="opacity-90">Musique illimitée</p>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-gray-800 mb-4">3 000 FCFA<span class="text-sm text-gray-500">/mois</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Qualité audio optimale</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Mode hors connexion</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Sans publicité</li>
                        </ul>
                        <a href="#" class="block text-center bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition-colors">
                            Choisir cette offre
                        </a>
                    </div>
                </div>

                <!-- Nouvelle carte Apple Music -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gradient-to-r from-gray-900 to-gray-700 p-6 text-white">
                        <h3 class="text-2xl font-bold">Apple Music</h3>
                        <p class="opacity-90">Catalogue complet</p>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-gray-800 mb-4">3 000 FCFA<span class="text-sm text-gray-500">/mois</span></div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Audio Lossless</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Audio spatial</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Lyrics en temps réel</li>
                        </ul>
                        <a href="#" class="block text-center bg-gray-900 text-white py-3 rounded-xl hover:bg-gray-800 transition-colors">
                            Choisir cette offre
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nouvelle section FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-16">Questions Fréquentes</h2>
            <div class="max-w-3xl mx-auto space-y-6">
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-3">Comment fonctionne le service ?</h3>
                    <p class="text-gray-600">Après votre paiement, vous recevez immédiatement vos identifiants par email. Notre équipe est disponible 24/7 pour vous accompagner.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-3">Les comptes sont-ils garantis ?</h3>
                    <p class="text-gray-600">Oui, tous nos comptes sont garantis pendant toute la durée de l'abonnement. En cas de problème, nous les remplaçons gratuitement.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-3">Quels sont les moyens de paiement acceptés ?</h3>
                    <p class="text-gray-600">Nous acceptons les paiements par Orange Money, MTN Money, Wave et Moov Money pour votre convenance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section À propos -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Qui sommes-nous -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Qui sommes-nous ?</h3>
                    <div class="relative">
                        <p class="text-gray-300" :class="{ 'line-clamp-3': !expanded }">
                            GetYourAccounts225 est votre guichet unique pour accéder à une multitude d'abonnements numériques de premier ordre, offrant une expérience de divertissement complète à portée de clic. Notre plateforme conviviale vous permet d'explorer et d'acheter facilement des abonnements à des services populaires tels que Netflix, Spotify, Prime Video, Disney+, IPTV, et bien plus encore.
                        </p>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>

                <!-- Pourquoi nous choisir -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Pourquoi nous choisir ?</h3>
                    <div class="relative">
                        <p class="text-gray-300" :class="{ 'line-clamp-3': !expanded }">
                            En choisissant GetYourAccounts225, vous bénéficiez non seulement d'un accès à une variété de contenus de qualité, mais également d'une expérience client exceptionnelle. Notre équipe est disponible 24h/24 et 7j/7 pour répondre à vos questions, vous guider dans vos choix et résoudre tout problème éventuel.
                        </p>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>

                <!-- Nos tarifs -->
                <div class="bg-gray-800 p-8 rounded-xl" x-data="{ expanded: false }">
                    <h3 class="text-2xl font-bold mb-4 text-white">Nos tarifs</h3>
                    <div class="relative">
                        <div :class="{ 'line-clamp-3': !expanded }">
                            <p class="text-gray-300">
                                Nous nous engageons à vous offrir des tarifs compétitifs et des promotions attractives, vous permettant de profiter de vos abonnements préférés tout en maîtrisant votre budget. De plus, notre plateforme sécurisée garantit que vos informations personnelles sont protégées à chaque étape de votre transaction.
                            </p>
                        </div>
                        <button @click="expanded = !expanded" class="text-red-500 font-semibold mt-4 hover:text-red-600">
                            <span x-text="expanded ? 'Voir moins' : 'Lire plus'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer moderne -->
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




