<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Assuming these are essential for your theme -->
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/img/logo/favicon.png" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // You can define your custom theme colors here if needed
                        // For example:
                        // 'primary': '#007bff',
                        // 'secondary': '#6c757d',
                        // 'success': '#28a745',
                        // 'danger': '#dc3545',
                        // 'warning': '#ffc107',
                        // 'info': '#17a2b8',
                        // 'light': '#f8f9fa',
                        // 'dark': '#343a40',
                        // 'textBody': '#555',
                        // 'text2': '#777',
                        // 'gray6': '#e5e7eb', // Example for border-gray6
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar (optional, for a more polished look) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /* For up/down arrows in badges */
        .badge .fas.up { color: #10B981; /* Tailwind green-500 */ }
        .badge .fas.down { color: #EF4444; /* Tailwind red-500 */ }

        /* More specific color handling for traffic source if Tailwind JIT has issues with dynamic values */
        /* You might not need this if your Tailwind JIT compilation is set up correctly */
        .traffic-bar-bg {
            background-color: rgba(var(--bar-color-rgb), 0.1);
        }
        .traffic-bar-fg {
            background-color: rgb(var(--bar-color-rgb));
        }
    </style>
</head>
<body class="bg-slate-100">

    <div class="tp-main-wrapper min-h-screen flex" x-data="{ sideMenu: false }">
        @include('dashboard.components.sideleft')

        <!-- Overlay for mobile menu -->
        <div class="fixed inset-0 z-40 bg-black/70 transition-opacity duration-300 lg:hidden"
             :class="sideMenu ? 'opacity-100 visible' : 'opacity-0 invisible'"
             x-on:click="sideMenu = false">
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 tp-main-content lg:ml-[250px] xl:ml-[300px]" x-data="{ searchOverlay: false }">
            @include('dashboard.components.header')

            <main class="body-content px-6 py-8 md:px-8 md:py-10">
                <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                        <p class="text-gray-600 mt-1">Bienvenue
                            <span class="font-semibold text-indigo-600">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
                            sur votre tableau de bord.
                        </p>
                    </div>
                    <div>
                        <a href="ajouter-produits"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-150 ease-in-out flex items-center">
                           <i class="fas fa-plus mr-2"></i> Ajouter Produits
                        </a>
                    </div>
                </div>

                <!-- Stats Cards Row 1 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                    <!-- Card 1: Total Commandes reçues -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Commandes reçues</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalOrders, 0) }}</h3>
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $orderPercentage >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ number_format($orderPercentage, 2) }}%
                                <i class="fas {{ $orderPercentage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} ml-1"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-500 text-white shrink-0">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 2: Montant total -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Montant de commande</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($statusData['encours']['total_amount'], 2, ',', ' ') }} DT</h3>
                            <!-- Placeholder for potential badge
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                N/A
                            </div>
                            -->
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-purple-500 text-white shrink-0">
                            <i class="fas fa-money-bill-wave text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 3: Nouveaux clients -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nouveaux clients (mois)</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalClients) }}</h3>
                            <!-- Placeholder for potential badge
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                N/A
                            </div>
                            -->
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-500 text-white shrink-0">
                            <i class="fas fa-user-friends text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 4: Commandes en attente -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Commandes en attente</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $statusData['encours']['order_count'] }}</h3>
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <!-- Example: 10% <i class="fas fa-arrow-up ml-1"></i> -->
                                <!-- You might need a dynamic value here -->
                            </div>
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-500 text-white shrink-0">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards Row 2 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
                    <!-- Card 5: Commandes annulées -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Commandes annulées</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $statusData['annulé']['order_count'] }}</h3>
                            <!-- Placeholder for potential badge
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                N/A
                            </div>
                            -->
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-500 text-white shrink-0">
                            <i class="fas fa-times-circle text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 6: Montant des commandes annulées -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Montant commandes annulées</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($statusData['annulé']['total_amount'], 2, ',', ' ') }} DT</h3>
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-pink-500 text-white shrink-0">
                             <i class="fas fa-ban text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 7: Commandes livrées -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Commandes livrées</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $statusData['traité']['order_count'] }}</h3>
                            <!-- Placeholder for potential badge
                            <div class="badge mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                N/A
                            </div>
                            -->
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-teal-500 text-white shrink-0">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 8: Montant des commandes livrées -->
                    <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Montant commandes livrées</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($statusData['traité']['total_amount'], 2, ',', ' ') }} DT</h3>
                        </div>
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-sky-500 text-white shrink-0">
                            <i class="fas fa-truck text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-10">
                    <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Statistiques de ventes</h2>
                        <div class="min-h-[350px]"><canvas id="salesStatics"></canvas></div>
                        <script>
                            const ventesData = @json($ventesParMois);
                            const produitsData = @json($produitsParMois);
                        </script>
                    </div>
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Catégorie la plus vendue</h2>
                        <div class="flex justify-center items-center min-h-[350px]">
                            <canvas id="earningStatics" class="max-w-[300px] max-h-[300px]"></canvas>
                        </div>
                        <script>
                            const labelsCategorie = @json($labels);
                            const dataCategorie = @json($data);
                        </script>
                    </div>
                </div>

                <!-- Data Tables & Info Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                    <!-- Distribution par sexe -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Distribution par sexe</h2>
                        <div class="space-y-4">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Sexe</th>
                                        <th scope="col" class="px-4 py-3 text-right">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sexDistribution as $item)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-900">
                                            {{ $item['sex'] === 'male' ? 'Homme' : 'Femme' }}
                                        </td>
                                        <td class="px-4 py-3 text-right">{{ $item['count'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TOP SKU Vente -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">TOP SKU Vente</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">SKU</th>
                                        <th scope="col" class="px-4 py-3 text-center">Quantité Vendue</th>
                                        <th scope="col" class="px-4 py-3 text-right">CA (DT)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topSKU as $sku)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $sku->SKU }}</td>
                                        <td class="px-4 py-3 text-center">{{ $sku->total_quantity_sold }}</td>
                                        <td class="px-4 py-3 text-right">{{ number_format($sku->total_revenue, 2, ',', ' ') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                 <!-- Second Row of Data Tables & Info -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                    <!-- Distribution par âge -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Distribution par âge</h2>
                        <ul class="space-y-3">
                            @foreach ($ageDistribution as $ageRange => $count)
                            <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100">
                                <span class="text-sm font-medium text-gray-700">{{ $ageRange }}</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $count }} personne{{ $count > 1 ? 's' : '' }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Commandes (Top Orders) -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Commandes Récentes/Top</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Référence</th>
                                        <th scope="col" class="px-4 py-3">Nom du client</th>
                                        <th scope="col" class="px-4 py-3 text-right">CA (DT)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topOrders as $order)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $order->reference_commande }}</td>
                                        <td class="px-4 py-3">{{ $order->nom_client }}</td>
                                        <td class="px-4 py-3 text-right">{{ number_format($order->chiffre_affaires, 2, ',', ' ') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Traffic Source & Weekly Comparison Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                    <!-- Traffics Source -->
                    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Sources de Traffic</h2>
                        @php
                            $sourceColors = [
                                'Facebook' => ['hex' => '#3b5998', 'rgb' => '59, 89, 152'],
                                'YouTube' => ['hex' => '#FF0000', 'rgb' => '255, 0, 0'],
                                'WhatsApp' => ['hex' => '#25D366', 'rgb' => '37, 211, 102'],
                                'Instagram' => ['hex' => '#E4405F', 'rgb' => '228, 64, 95'], // Changed Instagram color
                                'Others' => ['hex' => '#737373', 'rgb' => '115, 115, 115'],
                            ];
                        @endphp
                        <div class="space-y-5">
                            @foreach ($sourceDataPercent as $source => $percent)
                                @php
                                    $colorInfo = $sourceColors[$source] ?? $sourceColors['Others'];
                                @endphp
                                <div class="bar">
                                    <div class="flex justify-between items-center mb-1">
                                        <h5 class="text-sm font-medium text-gray-700">{{ $source }}</h5>
                                        <span class="text-sm text-gray-600">{{ $percent }}%</span>
                                    </div>
                                    <div class="relative h-2.5 w-full rounded traffic-bar-bg" style="--bar-color-rgb: {{ $colorInfo['rgb'] }};">
                                        <div class="absolute top-0 left-0 h-full rounded traffic-bar-fg"
                                             style="width: {{ $percent }}%; --bar-color-rgb: {{ $colorInfo['rgb'] }};">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Comparaison des Commandes (Weekly) -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Comparaison Commandes Semestrielles</h2>
                        <div class="space-y-6">
                            @foreach($thisWeekData as $index => $dataPoint)
                                @php
                                    $mois = $dataPoint[0];
                                    $semaineActuelle = $dataPoint[1];
                                    $semaineDerniere = $lastWeekData[$index][1] ?? 0;
                                    $total = max($semaineActuelle + $semaineDerniere, 1); // Avoid division by zero for percentage
                                    $percentActuelle = $total > 0 ? round(($semaineActuelle / $total) * 100) : 0;
                                    $percentDerniere = $total > 0 ? round(($semaineDerniere / $total) * 100) : 0;
                                @endphp
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-700 mb-2">{{ $mois }}</h5>
                                    <div class="space-y-2">
                                        <div>
                                            <div class="mb-1 flex justify-between">
                                                <span class="text-xs text-blue-600 font-medium">Cette Semaine ({{ $semaineActuelle }})</span>
                                                <span class="text-xs text-blue-600 font-medium">{{ $percentActuelle }}%</span>
                                            </div>
                                            <div class="relative h-2 w-full bg-blue-100 rounded-full">
                                                <div class="absolute top-0 left-0 h-full rounded-full bg-blue-500" style="width: {{ $percentActuelle }}%;"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="mb-1 flex justify-between">
                                                <span class="text-xs text-red-600 font-medium">Semaine Dernière ({{ $semaineDerniere }})</span>
                                                <span class="text-xs text-red-600 font-medium">{{ $percentDerniere }}%</span>
                                            </div>
                                            <div class="relative h-2 w-full bg-red-100 rounded-full">
                                                <div class="absolute top-0 left-0 h-full rounded-full bg-red-500" style="width: {{ $percentDerniere }}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <!-- Full Width Tables Section -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                     <!-- État de commande par mois -->
                     <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">État des commandes par mois</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Mois</th>
                                        <th scope="col" class="px-4 py-3 text-center">Totales</th>
                                        <th scope="col" class="px-4 py-3 text-center">En Attente</th>
                                        <th scope="col" class="px-4 py-3 text-center">Livrées</th>
                                        <th scope="col" class="px-4 py-3 text-center">Annulées</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $moisNoms = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc']; @endphp
                                    @foreach($moisNoms as $i => $moisNom)
                                    @php $mois = $i + 1; @endphp
                                    <tr class="bg-white border-b hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $moisNom }}</td>
                                        <td class="px-4 py-3 text-center">{{ $monthlyTotalOrders[$mois] ?? 0 }}</td>
                                        <td class="px-4 py-3 text-center">{{ $monthlyPendingOrders[$mois] ?? 0 }}</td>
                                        <td class="px-4 py-3 text-center">{{ $monthlyDeliveredOrders[$mois] ?? 0 }}</td>
                                        <td class="px-4 py-3 text-center">{{ $monthlyCanceledOrders[$mois] ?? 0 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Commande par Mode de paiement -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Commandes par Mode de Paiement</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Mode de Paiement</th>
                                        <th scope="col" class="px-4 py-3 text-right">Nombre de Commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paymentData as $mode => $count)
                                    <tr class="bg-white border-b hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $mode }}</td>
                                        <td class="px-4 py-3 text-right">{{ $count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Commande par Gouvernorat -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Commandes par Gouvernorat</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Gouvernorat</th>
                                        <th scope="col" class="px-4 py-3 text-right">Nombre de Commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats as $stat)
                                    <tr class="bg-white border-b hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $stat->gouvernorat }}</td>
                                        <td class="px-4 py-3 text-right">{{ $stat->nombre_commandes }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>

    @include('dashboard.components.js')
</body>
</html>