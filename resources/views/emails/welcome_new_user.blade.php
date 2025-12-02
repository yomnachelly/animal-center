<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenue sur Animal Center</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .content {
            padding: 20px;
            background: white;
        }
        .welcome-text {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin: 20px 0;
        }
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .info-item {
            margin: 8px 0;
            color: #555;
        }
        .cta-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            display: inline-block;
            margin: 20px 0;
            text-align: center;
        }
        .services-list, .info-list {
            margin: 15px 0;
            padding-left: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Bienvenue sur Animal Center !</h1>
    </div>

    <div class="content">
        <h2>Bonjour {{ $user->name }} !</h2>

        <div class="welcome-text">
            Félicitations et bienvenue dans notre communauté ! Vous faites désormais partie de la famille Animal Center, où nous prenons soin de vos compagnons comme s'ils étaient les nôtres.
        </div>

        <h3>🐾 Vos services disponibles :</h3>
        <ul class="services-list">
            <li><strong>🏠 Adoption d'animaux</strong> - Trouvez votre futur compagnon</li>
            <li><strong>📅 Hébergement</strong> - Réservation pour vos animaux</li>
            <li><strong>👨‍⚕️ Suivi vétérinaire</strong> - Santé et bien-être de vos compagnons</li>
        </ul>

        <div class="info-card">
            <h3 style="margin-top: 0; color: #333;">📋 Vos informations :</h3>
            <div class="info-item">
                <strong>👤 Nom :</strong> {{ $user->name }}
            </div>
            <div class="info-item">
                <strong>📧 Email :</strong> {{ $user->email }}
            </div>
            <div class="info-item">
                <strong>📞 Téléphone :</strong> {{ $user->telephone }}
            </div>
            <div class="info-item">
                <strong>🏠 Adresse :</strong> {{ $user->adresse }}
            </div>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/login') }}" class="cta-button">🚀 Accéder à mon compte</a>
        </div>

        <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
            <h3 style="color: #333; margin-top: 0;">💡 Besoin d'aide ?</h3>
            <p style="color: #666; margin: 10px 0;">
                Notre équipe est là pour vous accompagner dans toutes vos démarches.
            </p>
        </div>
    </div>

    <div class="footer">
        <p>Merci de nous avoir rejoint,</p>
        <p><strong>🐕 L'équipe Animal Center</strong></p>
        <p style="font-size: 12px; margin-top: 20px;">
            Si vous n'êtes pas à l'origine de cette inscription, veuillez nous contacter immédiatement.
        </p>
    </div>
</body>
</html>