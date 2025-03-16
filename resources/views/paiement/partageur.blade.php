<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Paiement de l'abonnement Partageur</h2>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-600">Montant à payer: <span class="font-semibold">1000 FCFA</span></p>
                        <p class="text-gray-600">Durée: <span class="font-semibold">1 mois</span></p>
                    </div>

                    <form action="{{ route('paytech.payment') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="montant" value="1000">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="type" value="partageur_abonnement">

                        <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors">
                            Payer avec PayTech
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>