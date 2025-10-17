<?php
// Sécurisation et récupération des données
$prenom    = $_POST['prenom'];
$nom       = $_POST['nom'];
$email     = $_POST['email'];
$telephone = $_POST['telephone'];
$type_rdv  = $_POST['type_rdv'];
$date_rdv  = $_POST['date_rdv'];
$heure_rdv = $_POST['heure_rdv'];
$motif     = $_POST['motif'];

// Import des classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chargement des fichiers PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Création de l'instance
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

try {
    // Configuration SMTP Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username   = 'sasfanega2@gmail.com'; // Votre adresse Gmail
    $mail->Password   = 'mzyu iuun rdvt rkqp'; // Mot de passe ou mot de passe d'application
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Expéditeur et destinataire
    $mail->setFrom('sasfanega2@gmail.com', 'Fanega rénovation');
    $mail->addAddress('sasfanega2@gmail.com', 'Fanega rénovation'); // Toi
    $mail->addReplyTo($email, "$prenom $nom"); // Pour répondre au client

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = "  Fanega rénovation - $prenom $nom";
    $mail->Body = "
        <h2 style='color:#2C3E50;'>Nouveau rendez-vous</h2>
        <p><strong>Nom complet :</strong> $prenom $nom</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Téléphone :</strong> $telephone</p>
        <p><strong>Type de rendez-vous :</strong> $type_rdv</p>
        <p><strong>Date :</strong> $date_rdv</p>
        <p><strong>Heure :</strong> $heure_rdv</p>
        <p><strong>Motif :</strong></p>
        <p>$motif</p>
    ";
    $mail->AltBody = "
    Nom complet : $prenom $nom
    Email : $email
    Téléphone : $telephone
    Type de rendez-vous : $type_rdv
    Date : $date_rdv
    Heure : $heure_rdv
    Motif : $motif
    ";

    // Envoi
    $mail->send();

     // ✅ Redirection vers la page d'accueil
    header("Location: ../index.php?success=1");
    exit();

    echo "<p style='color:green; font-weight:bold;'>✅ Merci $prenom, votre demande de rendez-vous a bien été envoyée.<br>
    Nous reviendrons vers vous rapidement pour confirmation.</p>";

} catch (Exception $e) {
    echo "<p style='color:red; font-weight:bold;'>❌ Une erreur est survenue lors de l'envoi de votre demande.<br>
    Veuillez réessayer plus tard ou nous contacter par téléphone.</p>";

}
?>
