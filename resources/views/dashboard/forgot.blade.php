<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Réinitialisation du mot de passe</h1>
            <p class="text-gray-600 text-sm">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
        </div>

        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-md mb-5">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-md mb-5">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="votre@email.com">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-150">
                    Envoyer le lien
                </button>
            </div>
        </form>
    </div>

</body>
</html>
