<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Paiement annulé</h2>
                    <p class="text-gray-600 mb-6">Le paiement n'a pas été complété.</p>
                    <a href="{{ route('partageurs.dashboard') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>