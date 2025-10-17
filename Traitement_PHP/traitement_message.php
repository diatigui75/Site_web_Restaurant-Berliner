<?php
// Sécurisation et récupération des données
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Vérification des champs obligatoires
if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ Veuillez remplir tous les champs correctement : nom, email valide et message.");
}

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
    $mail->addAddress('sasfanega2@gmail.com', 'Fanega rénovation'); // <-- TOI
    $mail->addReplyTo($email, $name); // <-- Pour répondre au visiteur

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = "Fanega rénovation - $name";
    $mail->Body = "
        <h2 style='color:#2C3E50;'>Nouveau message reçu</h2>
        <p><strong>Nom :</strong> $name</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Message :</strong></p>
        <p>$message</p>
    ";
    $mail->AltBody = "Nom : $name\nEmail : $email\nMessage : $message";

    // Envoi
    $mail->send();
      // ✅ Redirection vers la page d'accueil
    header("Location: ../index.php?success=1");
    echo "✅ Merci $name, votre message a été envoyé avec succès !";
} catch (Exception $e) {
    echo "❌ Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
}
?>
