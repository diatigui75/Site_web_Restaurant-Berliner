<?php
session_start();

function afficherPanier() {
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        echo "<p>Votre panier est vide.</p>";
        return;
    }

    $totalPanier = 0;
    foreach ($_SESSION['panier'] as $index => $item) {
        echo "<div class='cart-item'>";
        echo "<p><strong>" . htmlspecialchars($item['kebab']) . "</strong></p>";
        if (!empty($item['sides'])) echo "<p>Accompagnements : " . implode(", ", $item['sides']) . "</p>";
        if (!empty($item['drinks'])) echo "<p>Boissons : " . implode(", ", $item['drinks']) . "</p>";
        if (!empty($item['extras'])) echo "<p>Suppléments : " . implode(", ", $item['extras']) . "</p>";
        if (!empty($item['sauces'])) echo "<p>Sauces : " . implode(", ", $item['sauces']) . "</p>";
        if (!empty($item['commentaire'])) echo "<p><em>Commentaire : " . htmlspecialchars($item['commentaire']) . "</em></p>";

        // Compteur quantité
        echo "<form method='post' action='panier1.php' style='display:inline-block;'>";
        echo "<button type='submit' name='decrease_quantity' value='$index'>-</button>";
        echo "<span style='margin:0 10px;'>" . $item['quantite'] . "</span>";
        echo "<button type='submit' name='increase_quantity' value='$index'>+</button>";
        echo "</form>";

        echo "<p>Prix unitaire : " . number_format($item['total'], 2, ',', ' ') . " €</p>";
        echo "<p>Prix total : " . number_format($item['total'] * $item['quantite'], 2, ',', ' ') . " €</p>";

        echo "<form method='post' action='panier1.php'>";
        echo "<button type='submit' name='remove_from_cart' value='$index'>Supprimer</button>";
        echo "</form>";

        echo "</div>";

        $totalPanier += $item['total'] * $item['quantite'];
    }

    echo "<div class='cart-total'>";
    echo "<p><strong>Total : " . number_format($totalPanier, 2, ',', ' ') . " €</strong></p>";
    echo "</div>";
}

afficherPanier();
?>
