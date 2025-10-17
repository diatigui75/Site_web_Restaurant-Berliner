<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: reservation.php");
        exit;
    } else {
        echo "Erreur lors de la suppression de la réservation.";
    }
} else {
    echo "ID de réservation non spécifié.";
}
?>
