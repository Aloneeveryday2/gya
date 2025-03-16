<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GetYourAccounts225</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 h-screen text-white p-5">
            <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
            <ul>
                <li class="mb-3"><a href="{{ route('admin.utilisateurs') }}" class="hover:text-gray-300">👥 Gérer les utilisateurs</a></li>
                <li class="mb-3"><a href="{{ route('admin.partageurs') }}" class="hover:text-gray-300">📤 Partageurs d’abonnements</a></li>
                <li class="mb-3"><a href="{{ route('admin.paiements') }}" class="hover:text-gray-300">💰 Paiements</a></li>
                <li class="mb-3"><a href="{{ route('admin.abonnements') }}" class="hover:text-gray-300">📜 Abonnements</a></li>
                <li class="mt-6"><a href="{{ route('logout') }}" class="text-red-400 hover:text-red-600">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Contenu principal -->
        <main class="flex-1 p-10">
            <h2 class="text-3xl font-bold text-gray-700">Bienvenue, Admin 👋</h2>
            <p class="mt-2 text-gray-600">Gérez les utilisateurs, les paiements et les abonnements.</p>

            <div class="mt-6 grid grid-cols-3 gap-6">
                <div class="bg-white shadow-md p-5 rounded-md">
                    <h3 class="text-xl font-bold">👥 Utilisateurs</h3>
                    <p class="text-gray-600">{{ $nombreUtilisateurs }} inscrits</p>
                </div>

                <div class="bg-white shadow-md p-5 rounded-md">
                    <h3 class="text-xl font-bold">📤 Partageurs</h3>
                    <p class="text-gray-600">{{ $nombrePartageurs }} actifs</p>
                </div>

                <div class="bg-white shadow-md p-5 rounded-md">
                    <h3 class="text-xl font-bold">💰 Revenus</h3>
                    <p class="text-gray-600">{{ $totalPaiements }} FCFA</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
