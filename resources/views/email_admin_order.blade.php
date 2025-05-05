<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle commande</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px; color: #1f2937;">

    <div style="background-color: #ffffff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 700px; margin: auto;">
        <h1 style="font-size: 24px; font-weight: 700; color: #4f46e5; margin-bottom: 16px;">Nouvelle commande reçue</h1>
        <p style="margin-bottom: 16px; font-size: 14px;">Une nouvelle commande a été passée sur votre site. Voici les détails :</p>

        <ul style="margin-bottom: 24px; font-size: 14px; line-height: 1.6;">
            <li><strong>Référence de la commande :</strong> {{ $order->red_order ?? 'N/A' }}</li>
            <li><strong>Nom :</strong> {{ $order->nom ?? '' }} {{ $order->prenom ?? '' }}</li>
            <li><strong>Email :</strong> {{ $order->email ?? 'N/A' }}</li>
            <li><strong>Téléphone :</strong> {{ $order->telephone ?? 'N/A' }}</li>
            <li><strong>Adresse :</strong> {{ $order->adress ?? 'N/A' }}</li>
            <li><strong>Mode de paiement :</strong> {{ $order->mode_paiement ?? 'N/A' }}</li>
            <li><strong>Date de la commande :</strong> {{ $order->date_order ?? 'N/A' }}</li>
        </ul>

        <h2 style="font-size: 18px; font-weight: 600; color: #4338ca; margin-bottom: 12px;">Détails de la commande :</h2>

        @php
            $fraisLivraison = 8;
            $timbreFiscal = 1;
            $totalProduits = 0;
        @endphp

        <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 24px;">
            <thead style="background-color: #f3f4f6;">
                <tr>
                    <th style="border: 1px solid #d1d5db; padding: 8px;">Produit</th>
                    <th style="border: 1px solid #d1d5db; padding: 8px;">Quantité</th>
                    <th style="border: 1px solid #d1d5db; padding: 8px;">Prix unitaire (DT)</th>
                    <th style="border: 1px solid #d1d5db; padding: 8px;">Total (DT)</th>
                </tr>
            </thead>
            <tbody>
                @if($order && $order->product)
                    @php
                        $produitTotal = $order->quantite_produit * $order->prix_produit;
                        $totalProduits += $produitTotal;
                    @endphp
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $order->product->name }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $order->quantite_produit }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 8px;">{{ number_format($order->prix_produit, 3) }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 8px;">{{ number_format($produitTotal, 3) }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4" style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">Produit non disponible</td>
                    </tr>
                @endif

                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold; border: 1px solid #d1d5db; padding: 8px;">Frais de livraison</td>
                    <td style="border: 1px solid #d1d5db; padding: 8px;">{{ number_format($fraisLivraison, 3) }} DT</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold; border: 1px solid #d1d5db; padding: 8px;">Timbre fiscal</td>
                    <td style="border: 1px solid #d1d5db; padding: 8px;">{{ number_format($timbreFiscal, 3) }} DT</td>
                </tr>
                <tr style="background-color: #f9fafb;">
                    <td colspan="3" style="text-align: right; font-weight: bold; border: 1px solid #d1d5db; padding: 8px;">Total général</td>
                    <td style="border: 1px solid #d1d5db; padding: 8px;">{{ number_format($totalProduits + $fraisLivraison + $timbreFiscal, 3) }} DT</td>
                </tr>
            </tbody>
        </table>

        <p style="font-size: 13px; color: #6b7280;">Veuillez traiter cette commande dans les plus brefs délais.</p>
    </div>

</body>
</html>
