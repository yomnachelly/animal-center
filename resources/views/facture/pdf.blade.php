<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture d'hébergement</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-gray: #f5f5f5;
            --border-color: #ddd;
            --text-color: #333;
        }
        
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        h1 {
            color: var(--secondary-color);
            margin: 0;
            font-size: 28px;
        }
        
        .client-info {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .client-info p {
            margin: 5px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        
        thead {
            background-color: var(--primary-color);
            color: white;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        
        tbody tr {
            border-bottom: 1px solid var(--border-color);
        }
        
        tbody tr:nth-of-type(even) {
            background-color: #f8f9fa;
        }
        
        tbody tr:last-of-type {
            border-bottom: 2px solid var(--primary-color);
        }
        
        .total-section {
            text-align: right;
            margin-top: 20px;
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 5px;
        }
        
        .total-amount {
            font-size: 24px;
            color: var(--accent-color);
            font-weight: bold;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="logo">ANIMAL CENTER</div>
            <h1>Facture d'hébergement</h1>
        </div>
        
        <div class="client-info">
            <p><strong>Client :</strong> {{ $client->name ?? 'Nom non spécifié' }}</p>
            <p><strong>Email :</strong> {{ $client->email ?? 'Email non spécifié' }}</p>
            <p><strong>Téléphone :</strong> {{ $client->telephone ?? 'Téléphone non spécifié' }}</p>
            <p><strong>Adresse :</strong> {{ $client->adresse ?? 'Adresse non spécifiée' }}</p>
            <p><strong>Date de début :</strong> {{ $hebergement->date_debut }}</p>
            <p><strong>Date de fin :</strong> {{ $hebergement->date_fin }}</p>
            <p><strong>Nombre de jours :</strong> {{ $jours }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Prix par jour</th>
                    <th>Nombre de jours</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hébergement animal</td>
                    <td>{{ number_format($frais_par_jour, 2) }} DT</td>
                    <td>{{ $jours }}</td>
                    <td>{{ number_format($total, 2) }} DT</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p><strong>Total à payer : <span class="total-amount">{{ number_format($total, 2) }} DT</span></strong></p>
        </div>
        
        <div class="footer">
            <p>Merci pour votre confiance !</p>
            <p>Pour toute question, contactez-nous</p>
        </div>
    </div>
</body>
</html>