<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome optimisé -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"></noscript>
    <link rel="shortcut icon" href="../assets/img/logo/favicon.png" type="image/x-icon">

</head>
<body class="bg-slate-100">
    <div class="tp-main-wrapper h-screen" x-data="{ sideMenu: false }">
        @include('dashboard.components.sideleft')

        <!-- Overlay menu mobile -->
        <div class="fixed inset-0 z-40 bg-black/70 transition-opacity duration-300"
             :class="sideMenu ? 'visible opacity-100' : 'invisible opacity-0'"
             @click="sideMenu = false"
             x-show="sideMenu"
             x-transition></div>

        <div class="tp-main-content lg:ml-[250px] xl:ml-[300px] w-full max-w-[calc(100%-300px)]" x-data="{ searchOverlay: false }">
            @include('dashboard.components.header')

            <main class="body-content px-4 py-6 sm:px-8 sm:py-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 sm:mb-10">
                    <h1 class="text-2xl sm:text-[28px] font-semibold">Gestion des Utilisateurs</h1>
                </div>

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-600 flex-shrink-0"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Formulaire Ajout Utilisateur -->
                <div class="bg-white p-6 rounded-md shadow-sm mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-3 border-b">Ajouter un nouvel utilisateur</h2>
                    <form class="space-y-4" action="{{ route('dashboard.users.store') }}" method="POST">
                        @csrf
                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" required placeholder="Entrez le nom complet"
                                   value="{{ old('name') }}"
                                   class="w-full h-11 rounded-md border border-gray-300 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Adresse email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" required placeholder="Entrez l'adresse email"
                                   value="{{ old('email') }}"
                                   class="w-full h-11 rounded-md border border-gray-300 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Mot de passe <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required placeholder="Entrez un mot de passe"
                                       class="w-full h-11 rounded-md border border-gray-300 px-4 pr-10 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        onclick="togglePasswordVisibility('password')" aria-label="Afficher/Masquer mot de passe">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Type utilisateur -->
                        <div>
                            <label for="utype" class="block text-sm font-medium text-gray-700 mb-1">Type d'utilisateur</label>
                            <select name="utype" id="utype"
                                    class="w-full h-11 rounded-md border border-gray-300 px-4 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="USR" {{ old('utype', 'USR') == 'USR' ? 'selected' : '' }}>Utilisateur (Client)</option>
                                <option value="ADM" {{ old('utype') == 'ADM' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </div>

                        <!-- Bouton -->
                        <div class="pt-2">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 bg-black text-white hover:bg-gray-800 rounded-md transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-save mr-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Liste des utilisateurs -->
                <div class="bg-white p-6 rounded-md shadow-sm">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Liste des utilisateurs</h2>
                        <form action="{{ url()->current() }}" method="GET" class="w-full md:w-auto min-w-[250px]">
                            <div class="relative flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Rechercher par nom ou email..."
                                       class="w-full h-11 rounded-l-md border border-gray-300 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 text-sm font-medium">
                                    <i class="fas fa-search mr-1"></i> Rechercher
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tableau -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Nom</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-4">{{ $user->email }}</td>
                                    <td class="px-4 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->utype == 'ADM' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $user->utype == 'ADM' ? 'Administrateur' : 'Utilisateur' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href=""
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded bg-indigo-600 text-white hover:bg-indigo-700">
                                                <i class="fas fa-edit mr-1"></i> Modifier
                                            </a>
                                            <form action="" method="POST" onsubmit="return confirm('Confirmer la suppression ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded bg-red-600 text-white hover:bg-red-700">
                                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">Aucun utilisateur trouvé.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
        @include('dashboard.components.js')

</body>
</html>
