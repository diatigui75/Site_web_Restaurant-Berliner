<?php
$host = 'localhost';        // ou 127.0.0.1
$dbname = 'restaurant_db';
$username = 'root';         // change si ton utilisateur MySQL est différent
$password = '';             // mets ton mot de passe MySQL si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Active le mode d'erreur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>
