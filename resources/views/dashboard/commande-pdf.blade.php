<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande #{{ $red_order }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Commande #{{ $red_order }}</h2>
    <p>Client : {{ $ordersGroup[0]->nom }} {{ $ordersGroup[0]->prenom }}</p>
    <p>Date : {{ \Carbon\Carbon::parse($ordersGroup[0]->date_order)->format('d/m/Y H:i') }}</p>
    <p>Email : {{ $ordersGroup[0]->email }}</p>
    <p>Téléphone : {{ $ordersGroup[0]->telephone }}</p>
    <p>Adresse : {{ $ordersGroup[0]->adress }} - {{ $ordersGroup[0]->gouvernorat }}</p>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordersGroup as $order)
                <tr>
                    <td>{{ $order->produit }}</td>
                    <td>{{ $order->quantite }}</td>
                    <td>{{ $order->prix_unitaire }} DT</td>
                    <td>{{ $order->total }} DT</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total :</strong> {{ $ordersGroup->sum('total') }} DT</p>
</body>
</html>