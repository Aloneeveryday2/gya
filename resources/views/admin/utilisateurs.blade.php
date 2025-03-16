
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetYourAccounts225 - Utilisateurs</title>
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
                <a href="{{ route('admin.utilisateurs') }}" class="block p-3 bg-blue-600 rounded hover:bg-blue-500 transition mb-3">👥 Utilisateurs</a>
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
            <h1 class="text-3xl font-bold text-white mb-8">👥 Gestion des Utilisateurs</h1>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-700">Liste des Utilisateurs</h2>
                    <div class="flex gap-4">
                        <input type="text" placeholder="Rechercher..." class="px-4 py-2 border rounded-lg">
                        <select class="px-4 py-2 border rounded-lg">
                            <option value="">Tous les rôles</option>
                            <option value="user">Utilisateur</option>
                            <option value="partageur">Partageur</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' :
                                           ($user->role === 'partageur' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.supprimerUtilisateur', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>