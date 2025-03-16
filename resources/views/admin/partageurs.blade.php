<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetYourAccounts225 - Partageurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-72 bg-gray-900 text-white p-5 flex flex-col">
            <h2 class="text-2xl font-bold mb-6 text-center">⚡ Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">📊 Dashboard</a>
                <a href="{{ route('admin.utilisateurs') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">👥 Utilisateurs</a>
                <a href="{{ route('admin.partageurs') }}" class="block p-3 bg-blue-600 rounded hover:bg-blue-500 transition mb-3">🤝 Partageurs</a>
                <a href="{{ route('admin.transactions') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">💰 Transactions</a>

                <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit" class="w-full p-3 text-red-400 hover:bg-gray-700 rounded transition">
                        🚪 Déconnexion
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-white mb-8">🤝 Gestion des Partageurs</h1>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-700">Demandes d'approbation</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de demande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($partageurs as $partageur)
                            <tr>
                                <td class="px-6 py-4">{{ $partageur->user->name }}</td>
                                <td class="px-6 py-4">{{ $partageur->user->email }}</td>
                                <td class="px-6 py-4">{{ $partageur->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.approuverPartageur', $partageur->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                            Approuver
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Aucune demande en attente
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>