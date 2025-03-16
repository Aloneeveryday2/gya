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
<body class="bg-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-72 bg-gray-900 text-white p-5 flex flex-col">
            <h2 class="text-2xl font-bold mb-6 text-center"></h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block p-3 bg-blue-600 rounded hover:bg-blue-500 transition mb-3">📊 Dashboard</a>
                <a href="{{ route('admin.utilisateurs') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">👥 Utilisateurs</a>
                <a href="{{ route('admin.partageurs') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">🤝 Partageurs</a>
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
            <h1 class="text-3xl font-bold text-white mb-8"> Tableau de bord</h1>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <span class="text-2xl">👥</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Total Utilisateurs</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <span class="text-2xl">✅</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Partageurs Actifs</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $activePartageurs }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <span class="text-2xl">💰</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Revenus Totaux</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-700">📋 Dernières Transactions</h2>
                    <a href="{{ route('admin.transactions') }}" class="text-blue-600 hover:text-blue-800">Voir tout →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentTransactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                                    <td class="px-6 py-4">{{ $transaction->type }}</td>
                                    <td class="px-6 py-4">{{ number_format($transaction->amount, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-6 py-4">{{ $transaction->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs {{ $transaction->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $transaction->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Aucune transaction récente</td>
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

