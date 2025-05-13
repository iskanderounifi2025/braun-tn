<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande #{{ $red_order }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-white p-8">
    <div class="max-w-4xl mx-auto bg-white border border-gray-300 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Commande #{{ $red_order }}</h2>
        
        <div class="mb-4 space-y-1 text-gray-700">
            <p><strong>Client :</strong> {{ $ordersGroup[0]->nom }} {{ $ordersGroup[0]->prenom }}</p>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($ordersGroup[0]->date_order)->format('d/m/Y H:i') }}</p>
            <p><strong>Email :</strong> {{ $ordersGroup[0]->email }}</p>
            <p><strong>Téléphone :</strong> {{ $ordersGroup[0]->telephone }}</p>
            <p><strong>Adresse :</strong> {{ $ordersGroup[0]->adress }} - {{ $ordersGroup[0]->gouvernorat }}</p>
        </div>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full border border-gray-300 text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Produit</th>
                        <th class="border px-4 py-2">Quantité</th>
                        <th class="border px-4 py-2">Prix unitaire</th>
                        <th class="border px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordersGroup as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $order->produit }}</td>
                            <td class="border px-4 py-2">{{ $order->quantite }}</td>
                            <td class="border px-4 py-2">{{ $order->prix_unitaire }} DT</td>
                            <td class="border px-4 py-2">{{ $order->total }} DT</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="text-right font-semibold mt-6 text-lg">
            Total : {{ $ordersGroup->sum('total') }} DT
        </p>
    </div>
</body>
</html>