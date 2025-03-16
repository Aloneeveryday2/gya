<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Subscription Notice -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8 relative"> <!-- Ajout de relative ici -->
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Abonnement Partageur</h2>
                        <p class="text-gray-600 mt-1">Frais mensuel de 1000 FCFA pour partager vos abonnements</p>
                        @if(!$subscriptionActive)
                            <p class="text-red-600 mt-2">⚠️ Votre compte est actuellement limité. Payez votre abonnement pour partager vos services.</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Statut</p>
                        <p class="text-lg font-semibold {{ $subscriptionActive ? 'text-green-600' : 'text-red-600' }}">
                            {{ $subscriptionActive ? 'Actif' : 'Inactif' }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 flex gap-4">
                    <form action="{{ route('cinetpay.initiate') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Payer l'abonnement
                        </button>
                    </form>
                    <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors" {{ !$subscriptionActive ? 'disabled' : '' }}>
                        Historique des paiements
                    </button>
                </div>

            <!-- Disable features if subscription is not active -->
            @if(!$subscriptionActive)
                <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center">
                    <div class="bg-white p-6 rounded-xl shadow-lg max-w-md text-center">
                        <i class="fas fa-lock text-red-600 text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Accès Limité</h3>
                        <p class="text-gray-600 mb-4">Veuillez payer votre abonnement pour accéder à toutes les fonctionnalités de partage.</p>
                        <form action="{{ route('cinetpay.initiate') }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                Payer maintenant
                            </button>
                        </form>
                        <button onclick="this.parentElement.parentElement.parentElement.style.display='none'"
                                class="text-gray-600 hover:text-gray-800 transition-colors">
                            Fermer pour le moment
                        </button>
                    </div>
                </div>
            @endif

            <!-- Header Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Abonnés actifs</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $nombreAbonnes }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <i class="fas fa-money-bill text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Revenus du mois</h3>
                            <p class="text-3xl font-bold text-green-600">{{ number_format($revenuTotal, 0, ',', ' ') }} FCFA</p>                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <i class="fas fa-calendar-check text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Expiration abonnement</h3>
                            <p class="text-2xl font-semibold">{{ $subscriptionEnds ?? 'Non défini' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des abonnés -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Mes abonnés</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($subscribers ?? [] as $subscriber)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $subscriber->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $subscriber->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $subscriber->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $subscriber->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $subscriber->status ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-red-600 hover:text-red-900">Retirer</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Aucun abonné pour le moment
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Actions rapides -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-4">Gérer mon abonnement</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4 mb-8">
                            <a href="{{ route('partageurs.abonnements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Ajouter un abonnement
                            </a>
                            <a href="{{ route('partageurs.abonnes') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                                Gérer les abonnés
                            </a>
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <div class="space-y-4">
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Contacter le support
                        </button>
                        <button class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            FAQ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>