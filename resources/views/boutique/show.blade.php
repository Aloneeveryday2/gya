<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['name'] }} - GetYourAccounts225</title>
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <script>
        let currentAmount = {{ $service['price'] }};
        let selectedDuration = 1;

        document.addEventListener('DOMContentLoaded', function() {
            const basePrice = {{ $service['price'] }};
            const duration = document.getElementById('duration');
            const displayPrice = document.getElementById('displayPrice');
            const pricePerMonth = document.getElementById('pricePerMonth');

            function updatePrice() {
                selectedDuration = parseInt(duration.value);
                let discount = 0;

                switch(selectedDuration) {
                    case 3: discount = 0.05; break;
                    case 6: discount = 0.10; break;
                    case 12: discount = 0.15; break;
                }

                const totalPrice = basePrice * selectedDuration * (1 - discount);
                currentAmount = Math.round(totalPrice);
                const monthlyPrice = totalPrice / selectedDuration;

                displayPrice.textContent = new Intl.NumberFormat('fr-FR').format(totalPrice);
                pricePerMonth.textContent = `Soit ${new Intl.NumberFormat('fr-FR').format(monthlyPrice)} FCFA/mois`;
            }

            duration.addEventListener('change', updatePrice);
            updatePrice();
        });

        function checkout() {
            @if (!auth()->check())
                window.location.href = "{{ route('login') }}";
                return;
            @endif

            CinetPay.setConfig({
                apikey: '1909912046670bcc1a1ea5a8.16745284',
                site_id: '5881455',
                mode: 'SANDBOX'
            });

            CinetPay.getCheckout({
                transaction_id: 'GYA-' + Math.floor(Math.random() * 100000000).toString(),
                amount: currentAmount,
                currency: 'XOF',
                channels: 'ALL',
                description: '{{ $service['name'] }} - ' + selectedDuration + ' mois',
                notify_url: '{{ url("/api/cinetpay/callback") }}',
                return_url: '{{ route("dashboard") }}',
                customer_name: "{{ auth()->user()->name }}",
                customer_email: "{{ auth()->user()->email }}",
                customer_phone_number: '00000000',
                customer_address: 'Abidjan',
                customer_city: 'Abidjan',
                customer_country: 'CI',
                customer_state: 'CI',
                customer_zip_code: '00225'
            });

            CinetPay.waitResponse(function(data) {
                if (data.status == "REFUSED") {
                    alert("Votre paiement a échoué");
                    window.location.reload();
                } else if (data.status == "ACCEPTED") {
                    alert("Votre paiement a été effectué avec succès");
                    window.location.href = "{{ route('dashboard') }}";
                }
            });

            CinetPay.onError(function(data) {
                console.log(data);
            });
        }
    </script>
{{--         @if (!auth()->check())
            window.location.href = "{{ route('login') }}";
            return;
        @endif

        CinetPay.setConfig({
            apikey: '1909912046670bcc1a1ea5a8.16745284',
            site_id: '5881455',
            mode: 'PRODUCTION'
        });

        const userData = {
            name: "{{ auth()->check() ? auth()->user()->name : '' }}",
            email: "{{ auth()->check() ? auth()->user()->email : '' }}"
        };

        CinetPay.getCheckout({
            transaction_id: 'GYA-' + Math.floor(Math.random() * 100000000).toString(),
            amount: currentAmount,
            currency: 'XOF',
            channels: 'ALL',
            description: '{{ $service['name'] }} - ' + selectedDuration + ' mois',
            notify_url: 'https://de5e-160-120-117-152.ngrok-free.app/api/cinetpay/callback', // 🔥 Ajout de notify_url ici
            return_url: "{{ route('boutique.index') }}",
            customer_name: userData.name,
            customer_email: userData.email,
            customer_phone_number: '00000000',
            customer_address: 'Abidjan',
            customer_city: 'Abidjan',
            customer_country: 'CI',
            customer_state: 'CI',
            customer_zip_code: '00225'
        });

        CinetPay.waitResponse(function(data) {
            if (data.status == "REFUSED") {
                alert("Votre paiement a échoué");
                window.location.reload();
            } else if (data.status == "ACCEPTED") {
                alert("Votre paiement a été effectué avec succès");
                window.location.href = "{{ route('boutique.index') }}";
            }
        });

        CinetPay.onError(function(data) {
            console.log(data);
        }); --}}
    }

    </script>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header x-data="{ isOpen: false }" class="fixed w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-red-600 text-xl sm:text-2xl mr-2"></i>
                    <span class="text-lg sm:text-xl font-bold bg-gradient-to-r from-red-600 to-red-800 text-transparent bg-clip-text">GetYourAccounts225</span>
                </div>

                <!-- Mobile menu button -->
                <button @click="isOpen = !isOpen" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Desktop menu -->
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

            <!-- Mobile menu -->
            <div x-show="isOpen" class="md:hidden mt-4">
                <nav class="flex flex-col space-y-4">
                    <a href="{{ url("/Accueil") }}" class="text-gray-600 hover:text-blue-600 transition-colors">Accueil</a>
                    <a href="#offres" class="text-gray-600 hover:text-blue-600 transition-colors">Offres</a>
                    <a href="#faq" class="text-gray-600 hover:text-blue-600 transition-colors">FAQ</a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Mon compte</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-600 hover:text-blue-600 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Se connecter</a>
                        <a href="{{ route('register') }}" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition-colors text-center">S'inscrire</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <div class="pt-20 sm:pt-24 pb-8 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bouton retour -->
            <div class="mb-4 sm:mb-6">
                <a href="{{ url('/boutique') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la boutique
                </a>
            </div>

            <!-- Contenu principal -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Image du produit -->
                    <div class="w-full md:w-1/2">
                        <img src="{{ asset('storage/' . $service['image']) }}"
                             alt="{{ $service['name'] }}"
                             class="w-full h-64 sm:h-72 md:h-96 object-cover">
                    </div>

                    <!-- Informations du produit -->
                    <div class="w-full md:w-1/2 p-4 sm:p-6 md:p-8">
                        <div class="mb-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full"
                                  style="background-color: {{ $service['badge_color'] }}">
                                {{ $service['badge_text'] }}
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">{{ $service['name'] }}</h1>
                        <p class="text-sm sm:text-base text-gray-600 mb-6">{{ $service['description'] }}</p>

                        <!-- Prix et bouton d'achat -->
                        <div class="mb-6 sm:mb-8">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Durée de l'abonnement
                                </label>
                                <select id="duration" class="w-full px-3 sm:px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 text-sm sm:text-base">
                                    <option value="1">1 mois</option>
                                    <option value="3">3 mois (-5%)</option>
                                    <option value="6">6 mois (-10%)</option>
                                    <option value="12">12 mois (-15%)</option>
                                </select>
                            </div>

                            <div class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">
                                <span id="displayPrice">{{ number_format($service['price'], 0, ',', ' ') }}</span>
                                <span class="text-base sm:text-lg text-gray-600">FCFA</span>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-500 mb-4">
                                <span id="pricePerMonth"></span>
                            </div>

                            <button onclick="checkout()" class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors text-sm sm:text-base">
                                <span>Acheter maintenant</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                            </form>
                        </div>

                        <!-- Caractéristiques -->
                        <div class="border-t pt-4 sm:pt-6">
                            <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Caractéristiques incluses :</h2>
                            <ul class="space-y-2 sm:space-y-3">
                                @foreach($service['features'] as $feature)
                                <li class="flex items-center text-sm sm:text-base text-gray-600">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section FAQ -->
                <div class="p-4 sm:p-8 border-t">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Questions fréquentes</h2>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="border rounded-lg p-3 sm:p-4">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base">Comment fonctionne l'abonnement ?</h3>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">Une fois votre achat effectué, vous recevrez vos identifiants par email dans les plus brefs délais.</p>
                        </div>
                        <div class="border rounded-lg p-3 sm:p-4">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base">Quelle est la durée de l'abonnement ?</h3>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">L'abonnement est mensuel et se renouvelle automatiquement chaque mois.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <!-- ... même footer que la page index ... -->
    </footer>
</body>
</html>