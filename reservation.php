<?php
require_once 'config.php';
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Récupération des données envoyées par le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $phone = $_POST['phone'];
    $special_requests = $_POST['special_requests'] ?? '';

    // Validation des champs obligatoires
    if (empty($full_name) || empty($email) || empty($date) || empty($time) || empty($guests) || empty($phone)) {
        die("Erreur : Tous les champs obligatoires doivent être remplis.");
    }

    // Validation de l'e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erreur : L'adresse e-mail n'est pas valide.");
    }
    // Vérifier que l'heure est au format HH:MM
    if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/", $time)) {
        die("Erreur : Le format de l'heure n'est pas valide. Utilisez le format HH:MM (par exemple, 18:30).");
    }

    // Validation du numéro de téléphone
    if (!preg_match("/^[0-9\s]+$/", $phone)) {
        die("Erreur : Le numéro de téléphone n'est pas valide.");
    }

    // Vérifie si c'est une nouvelle réservation
    if ((isset($_POST['from_index']) && $_POST['from_index'] == '1') || isset($_POST['add_reservation'])) {
        try {
             // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO reservations (full_name, email, date, time, guests, phone, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $email, $date, $time, $guests, $phone, $special_requests]);

            // Envoi de l'e-mail de confirmation avec PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'diatiguifane2@gmail.com'; // Remplacez par votre adresse e-mail
                $mail->Password = 'dokq ieum bzak fkia'; // Remplacez par votre mot de passe
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Définition de l'expéditeur et du destinataire
                $mail->setFrom('votre-email@gmail.com', $full_name);
                $mail->addAddress($email);

                // Contenu de l'e-mail
                $mail->isHTML(false);
                $mail->Subject = 'Confirmation de reservation';
                $mail->Body =  "Bonjour $full_name,

Nous vous remercions pour votre réservation chez ORIGINE - BK. Voici un récapitulatif de votre réservation :

Date : $date
Heure : $time
Nombre de personnes : $guests
" . (!empty($special_requests) ? "Demandes spéciales : $special_requests\n" : "") . "

Nous nous réjouissons de vous accueillir et restons à votre disposition pour toute question ou modification.

Cordialement,

L'équipe du Restaurant ORIGINE - BK
Téléphone : 09 79 14 48 70
Adresse : 19 Rue du Mirail, 33000 Bordeaux
";


                $mail->send();
                echo 'Réservation enregistrée avec succès et e-mail de confirmation envoyé!';
            } catch (Exception $e) {
                echo "Réservation enregistrée avec succès, mais l'envoi de l'e-mail de confirmation a échoué. Erreur : {$mail->ErrorInfo}";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement de la réservation: " . $e->getMessage();
        }
    }
}

// Mettre à jour une réservation existante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_reservation'])) {
     // Récupération des données
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $phone = $_POST['phone'];
    $special_requests = $_POST['special_requests'];

    try {
         // Requête SQL pour modifier la réservation
        $stmt = $pdo->prepare("UPDATE reservations SET full_name = ?, email = ?, date = ?, time = ?, guests = ?, phone = ?, special_requests = ? WHERE id = ?");
        $stmt->execute([$full_name, $email, $date, $time, $guests, $phone, $special_requests, $id]);
        echo "Réservation mise à jour avec succès!";
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour de la réservation: " . $e->getMessage();
    }
}

// Supprimer une réservation
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        echo "Réservation supprimée avec succès !";
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de la réservation: " . $e->getMessage();
        exit;
    }
}



// Récupérer toutes les réservations
try {
    $reservations = $pdo->query("SELECT * FROM reservations")->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des réservations: " . $e->getMessage();
}
//Redirection vers index.html

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations</title>
    <link rel="stylesheet" href="Dossier_CSS/reservation.css">
       <script src="Dossier_JS/reservation.js"></script>
</head>
<body>
    <h1>Liste des Réservations</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom Complet</th>
            <th>Email</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nombre de personnes</th>
            <th>Téléphone</th>
            <th>Demandes spéciales</th>
            <th>Actions</th>
        </tr>
         <!-- Boucle sur chaque réservation pour afficher les données -->
        <?php foreach ($reservations as $reservation): ?>
        <tr id="reservation-<?= $reservation['id'] ?>">
            <!-- On sécurise l'affichage avec htmlspecialchars pour éviter le XSS -->
            <td><?= htmlspecialchars($reservation['id']) ?></td>
            <td><?= htmlspecialchars($reservation['full_name']) ?></td>
            <td><?= htmlspecialchars($reservation['email']) ?></td>
            <td><?= htmlspecialchars($reservation['date']) ?></td>
            <td><?= htmlspecialchars($reservation['time']) ?></td>
            <td><?= htmlspecialchars($reservation['guests']) ?></td>
            <td><?= htmlspecialchars($reservation['phone']) ?></td>
            <td><?= htmlspecialchars($reservation['special_requests']) ?></td>
            <td class="action-buttons">
                <button class="edit-button" onclick="editReservation(<?= $reservation['id'] ?>)">Modifier</button>
                <button class="delete-button" onclick="deleteReservation(<?= $reservation['id'] ?>)">Supprimer</button>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </table>

    
</body>
</html>
