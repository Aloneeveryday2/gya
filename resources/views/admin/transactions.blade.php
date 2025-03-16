<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetYourAccounts225 - Transactions</title>
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
                <a href="{{ route('admin.partageurs') }}" class="block p-3 hover:bg-gray-700 rounded transition mb-3">🤝 Partageurs</a>
                <a href="{{ route('admin.transactions') }}" class="block p-3 bg-blue-600 rounded hover:bg-blue-500 transition mb-3">💰 Transactions</a>

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
            <h1 class="text-3xl font-bold text-white mb-8">💰 Historique des Transactions</h1>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-700">Toutes les transactions</h2>
                    <div class="flex gap-4">
                        <input type="text" placeholder="Rechercher..." class="px-4 py-2 border rounded-lg">
                        <select class="px-4 py-2 border rounded-lg">
                            <option value="">Tous les statuts</option>
                            <option value="success">Réussi</option>
                            <option value="pending">En attente</option>
                            <option value="failed">Échoué</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4">#{{ $transaction->id }}</td>
                                <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                                <td class="px-6 py-4">{{ $transaction->type }}</td>
                                <td class="px-6 py-4">{{ number_format($transaction->amount, 0, ',', ' ') }} FCFA</td>