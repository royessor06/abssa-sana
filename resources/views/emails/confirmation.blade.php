<!DOCTYPE html>
<html>
<body>
    <h2>Confirmation de votre alerte sanitaire</h2>

    <p>Bonjour,</p>

    <p>Votre alerte a été enregistrée avec succès.</p>

    <p><strong>Votre numéro de suivi :</strong></p>
    <div style="background: #f0f0f0; padding: 15px; font-size: 18px; font-weight: bold; margin: 15px 0;">
        {{ $numeroSuivi }}
    </div>

    <p><strong>Produit concerné :</strong> {{ $nomProduit }}</p>
    <p><strong>Date :</strong> {{ $dateDeclaration }}</p>

    <p>Vous pouvez utiliser ce numéro pour suivre l'avancement de votre alerte.</p>

    <hr>
    <p style="color: #666; font-size: 12px;">
        ABSSA - Agence Béninoise de Sécurité Sanitaire des Aliments<br>
        Ceci est un email automatique, merci de ne pas y répondre.
    </p>
</body>
</html>
