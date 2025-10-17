<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Réservation</title>
    <link rel="stylesheet" href="Dossier_CSS/ajouter.css">
</head>
<body>
    <h1>Ajouter une Réservation</h1>
    <div class="reservation-form">
        <form action="reservation.php"  method="POST">
            <input type="text" name="full_name" placeholder="Nom Complet" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <input type="number" name="guests" placeholder="Nombre de personnes" required>
            <input type="text" name="phone" placeholder="Téléphone" required>
            <textarea name="special_requests" placeholder="Demandes spéciales"></textarea>
            <button type="submit" name="add_reservation">Ajouter</button>
        </form>
    </div>
</body>
</html>
