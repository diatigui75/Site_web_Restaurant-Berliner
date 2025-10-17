<?php // Récupération et validation des données
$type_travaux = $_POST['type_travaux'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$code_postal = $_POST['code_postal'];
$ville = $_POST['ville'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$projet = $_POST['projet'];

// Import des classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Chargement des fichiers PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Création d'une instance de PHPMailer
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Serveur SMTP de Gmail
    $mail->SMTPAuth   = true;               // Activation de l'authentification SMTP
    $mail->Username   = 'sasfanega2@gmail.com'; // Votre adresse Gmail
    $mail->Password   = 'mzyu iuun rdvt rkqp'; // Mot de passe ou mot de passe d'application
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Chiffrement TLS implicite
    $mail->Port       = 465;               // Port TCP pour le chiffrement SMTPS

    // Expéditeur et destinataire
    $mail->setFrom('sasfanega2@gmail.com', 'Fanega rénovation');
    $mail->addAddress('sasfanega2@gmail.com', 'Fanega rénovation'); // <-- TOI
    $mail->addAddress($email, "$prenom $nom"); // Utilise l'e-mail et le nom du formulaire

    // Contenu de l'e-mail (version HTML)
    $mail->isHTML(true);
    $mail->Subject = "Confirmation de réception de votre demande – $type_travaux";
    $mail->Body = "
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta charset='UTF-8'>
</head>
<body style='font-family: Arial, sans-serif; line-height:1.6; color:#333; max-width:600px; margin:0 auto; padding:20px;'>
    <div style='background-color:#f4f4f4; padding:15px; text-align:center; border-bottom:1px solid #e0e0e0;'>
        <h2 style='margin:0;'>Merci pour votre confiance, $prenom $nom !</h2>
    </div>
    <div style='padding:20px;'>
        <p>Bonjour $prenom,</p>
        <p>Nous accusons réception de votre demande concernant <strong>$type_travaux</strong> pour le projet suivant :</p>
        
        <div style='background-color:#e6e6fa; padding:15px; border-radius:4px; margin:15px 0;'>
            <p><strong>Description du projet :</strong></p>
            <p>$projet</p>
            <p><strong>Adresse du projet :</strong> $adresse, $code_postal $ville</p>
        </div>
        
        <p>Notre équipe examine actuellement votre demande et reviendra vers vous dans les plus brefs délais pour vous proposer une solution adaptée à vos besoins.</p>
        
        <p>En attendant, n’hésitez pas à nous contacter pour toute question ou précision supplémentaire :</p>
        <p><strong>Téléphone :</strong>+33 6 59 31 91 39 <br>
        <strong>E-mail :</strong>sasfanega@hotmail.com</p>
        
        <p>Cordialement,</p>
        <p><strong>Fadjigui FANE</strong><br>DG de FANEGA Rénovation<br>FANEGA - Bulding rénovation<br>
    
    </div>
    <div style='margin-top:20px; padding:10px; text-align:center; font-size:12px; color:#777; border-top:1px solid #e0e0e0;'>
        <p>© " . date('Y') . " FANEGA Rénovation. Tous droits réservés.</p>
    </div>
</body>
</html>
";

    $mail->AltBody = "
        Bonjour $prenom,
        Nous accusons réception de votre demande concernant $type_travaux pour le projet suivant :
        Description du projet : $projet
        Adresse du projet : $adresse, $code_postal $ville
        Notre équipe examine actuellement votre demande.
        Contact : +33 06 59 31 91 39 | diatiguifane2@gmail.com
        Cordialement,
        Diatigui FANE
        PDG de FANEGA – www.avenir-renovations.fr
    ";


    // Envoi de l'e-mail
    $mail->send();
    // ✅ Redirection vers la page d'accueil
    header("Location: ../devis.php?success=1");
    echo "Votre message a été envoyé avec succès !";
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
}
