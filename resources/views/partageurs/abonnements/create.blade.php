<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-6">Ajouter un Abonnement</h1>

                    <form action="{{ route('partageurs.abonnements.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="type_service" class="block text-sm font-medium text-gray-700">Type de Service</label>
                            <select id="type_service" name="type_service" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Netflix">Netflix</option>
                                <option value="Spotify">Spotify</option>
                                <option value="Disney+">Disney+</option>
                                <option value="Apple Music">Apple Music</option>
                                <option value="Hulu">Hulu</option>
                                <option value="Amazon Prime Video">Amazon Prime Video</option>
                                <option value="Crunchyroll">Crunchyroll</option>
                                <option value="Paramount+">Paramount+</option>
                                <option value="HBO Max">HBO Max</option>
                            </select>
                        </div>

                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix mensuel (FCFA)</label>
                            <input type="number" name="prix" id="prix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="places_disponibles" class="block text-sm font-medium text-gray-700">Nombre de places</label>
                            <input type="number" name="places_disponibles" id="places_disponibles" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="duree" class="block text-sm font-medium text-gray-700">Durée (mois)</label>
                            <input type="number" name="duree" id="duree" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>


                        <div class="flex justify-end gap-4">
                            <a href="{{ route('partageurs.abonnements') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Ajouter l'abonnement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>