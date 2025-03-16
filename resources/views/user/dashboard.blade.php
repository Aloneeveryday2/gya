<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-6">Mon Tableau de Bord</h1>

                    <!-- User Info -->
                    <div class="mb-8">
                        <h2 class="text-xl font-medium mb-4">Mes Informations</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="mb-2"><span class="font-medium">Nom:</span> {{ $user->name }}</p>
                            <p class="mb-2"><span class="font-medium">Email:</span> {{ $user->email }}</p>
                            <p><span class="font-medium">Membre depuis:</span> {{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-4">Mes Abonnements</h3>
                            @if(empty($subscriptions))
                                <div class="text-gray-600 mb-4">
                                    Vous n'avez pas d'abonnement pour le moment.
                                </div>
                                <a href="{{ url('/boutique') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                    Découvrir nos offres
                                </a>
                            @else
                                <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Voir mes abonnements
                                </a>
                            @endif
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-4">Support</h3>
                            <a href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Contacter le support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>