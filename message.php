<?php
require_once 'config.php'; // Assurez-vous que ce fichier configure correctement votre connexion à la base de données
require __DIR__ . '/vendor/autoload.php'; // Inclure l'autoloader de Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nom = $_POST['nom'];
    $Email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $Message = $_POST['message'];

    // Validation de l'email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("Erreur : L'adresse e-mail n'est pas valide.");
    }

    // Envoi de l'e-mail avec PHPMailer
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

      // Destinataire
                $mail->setFrom('votre-email@gmail.com', $Nom);
                $mail->addAddress($Email);

        // Contenu de l'e-mail
        $mail->isHTML(false);
        $mail->Subject = $sujet;
        $mail->Body = "Bonjour $Nom,

Merci pour votre message. Voici un récapitulatif de votre demande :

---
Sujet : $sujet
Votre message :
$Message
---

Nous vous répondrons dans les plus brefs délais.

Cordialement,
ORIGINE - BK";

        $mail->send();
        header('Location: /index.html');
        echo 'Message envoyé avec succès!';
    } catch (Exception $e) {
        echo "L'envoi du message a échoué. Erreur : {$mail->ErrorInfo}";
    }
    exit;
}
?>
