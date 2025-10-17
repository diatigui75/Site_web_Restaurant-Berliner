<?php
// Démarre la session PHP pour pouvoir stocker le panier dans $_SESSION
session_start();
$prices = [
    'Coca cola'=> 1.5,
    'Dada mangue'=> 1.5,
    'Eau plate'=> 1.5,
    'Eau petillante'=> 1.5,
    'Ice tea'=> 1.5,
    'Coca 0'=> 1.5,
    'Scheweppes agrum'=> 1.5,
    'Orangina'=> 1.5,
    'Bierre'=> 3,
    'Oasis'=> 1.5,
];
/**
 * Fonction pour calculer le total d'une commande
 */
function calculateTotal(array $order, array $prices): float {
    $total = 0.0;
    // Ajoute le prix des boissons
    if (!empty($order['drinks']) && is_array($order['drinks'])) {
        foreach ($order['drinks'] as $item) {
            if (isset($prices[$item])) {
                $total += $prices[$item];
            }
        }
    }
    // Retourne le prix arrondi à deux décimales
    return round($total, 2);
}

// Gestion des actions AJAX pour modifier le panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && !isset($_POST['add_to_cart'])) {
    header('Content-Type: application/json; charset=utf-8');
    $action = $_POST['action'];
    $index = isset($_POST['index']) ? (int)$_POST['index'] : null;
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    // Augmenter la quantité
    if ($action === 'increase' && $index !== null && isset($_SESSION['panier'][$index])) {
        $_SESSION['panier'][$index]['quantite']++;
        echo json_encode(['success' => true]);
        exit;
    }
    // Diminuer la quantité (ou supprimer si 1)
    if ($action === 'decrease' && $index !== null && isset($_SESSION['panier'][$index])) {
        if ($_SESSION['panier'][$index]['quantite'] > 1) {
            $_SESSION['panier'][$index]['quantite']--;
        } else {
            unset($_SESSION['panier'][$index]);
            $_SESSION['panier'] = array_values($_SESSION['panier']);
        }
        echo json_encode(['success' => true]);
        exit;
    }
    // Supprimer un article
    if ($action === 'remove' && $index !== null && isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']);
        echo json_encode(['success' => true]);
        exit;
    }
    // Définir une quantité exacte
    if ($action === 'set_qty' && $index !== null && isset($_SESSION['panier'][$index]) && isset($_POST['quantity'])) {
        $q = max(1, (int)$_POST['quantity']);
        $_SESSION['panier'][$index]['quantite'] = $q;
        echo json_encode(['success' => true]);
        exit;
    }
    // Action invalide
    echo json_encode(['success' => false, 'msg' => 'Action inconnue ou index invalide']);
    exit;
}

// Affichage du récapitulatif du panier (pour la fenêtre modale)
if (isset($_GET['action']) && $_GET['action'] === 'recap') {
    ob_start();
    if (empty($_SESSION['panier'])) {
        echo "<p>Votre panier est vide.</p>";
    } else {
        $totalPanier = 0;
        echo "<h3>Mon panier</h3>";
        foreach ($_SESSION['panier'] as $index => $item) {
            $unit = $item['total'];
            $qty = $item['quantite'];
            $lineTotal = $unit * $qty;
            $totalPanier += $lineTotal;
            echo "<div class='cart-item' data-index='{$index}'>";
            if (!empty($item['drinks'])) {
                echo "<p><strong>Boissons :</strong> " . implode(", ", array_map('htmlspecialchars', $item['drinks'])) . "</p>";
            }
            if (!empty($item['commentaire'])) {
                echo "<p><em><strong>Commentaire :</strong> " . htmlspecialchars($item['commentaire']) . "</em></p>";
            }
            echo "<p><strong>Prix unitaire :</strong> " . number_format($unit, 2, ',', ' ') . " €</p>";
            echo "<div class='quantity-controls'>";
            echo "<button class='btn-decrease' data-index='{$index}' aria-label='Diminuer'>-</button>";
            echo "<input class='qty-input' data-index='{$index}' type='number' min='1' value='{$qty}' style='width:60px; text-align:center;'>";
            echo "<button class='btn-increase' data-index='{$index}' aria-label='Augmenter'>+</button>";
            echo "</div>";
            echo "<p><strong>Prix ligne :</strong> <span class='line-total'>" . number_format($lineTotal, 2, ',', ' ') . " €</span></p>";
            echo "<button class='btn-remove' data-index='{$index}'>Supprimer</button>";
            echo "</div>";
        }
        echo "<div class='cart-total'><strong>Total du panier : " . number_format($totalPanier, 2, ',', ' ') . " €</strong></div>";
    }
    $html = ob_get_clean();
    echo $html;
    exit;
}

// Ajout d'un article au panier (via formulaire classique)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $drinks = isset($_POST['drinks']) && !empty($_POST['drinks']) ? $_POST['drinks'] : [];

    $order = [
        'drinks' => is_array($drinks) ? $drinks : [$drinks],
        'commentaire' => $_POST['commentaire'] ?? '',
    ];
    $order['total'] = calculateTotal($order, $prices);
    $order['quantite'] = 1;
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $order;
    header('Location: panier1.php');
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande de Boissons</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../Dossier_CSS/panier.css">
    <script src="../Dossier_JS/panier.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <button id="openRecap" class="panier-btn" type="button"></button>
            </div>
            <h1>Commandez vos boissons</h1>
            <p>Choisissez vos boissons en quelques clics</p>
        </header>
        <form method="post" action="" id="orderForm" class="grand_section">
            <!-- Inputs cachés pour stocker les sélections -->
            <input type="hidden" name="drinks[]" id="selectedDrinks" value="">
            <!-- Section Boissons -->
            <section class="section">
                <h2>1. Boissons</h2>
                <div class="drink-options">
                    <div class="drink-option" data-value="Cola" data-price="1.5">Cola (+1,5 €)</div>
                    <div class="drink-option" data-value="Dada mangue" data-price="1.5">Dada mangue (+1,5 €)</div>
                    <div class="drink-option" data-value="Eau plate" data-price="1.5">Eau plate (+1,5 €)</div>
                    <div class="drink-option" data-value="Eau petillante" data-price="1.5">Eau pétillante (+1,5 €)</div>
                    <div class="drink-option" data-value="Ice tea" data-price="1.5">Ice tea (+1,5 €)</div>
                    <div class="drink-option" data-value="Coca 0" data-price="1.5">Coca 0 (+1,5 €)</div>
                    <div class="drink-option" data-value="Scheweppes agrum" data-price="1.5">Scheweppes agrum (+1,5 €)</div>
                    <div class="drink-option" data-value="Orangina" data-price="1.5">Orangina (+1,5 €)</div>
                    <div class="drink-option" data-value="Oasis" data-price="1.5">Oasis (+1,5 €)</div>
                    <div class="drink-option" data-value="Bierre" data-price="1.5">Bière (+1,5 €)</div>
                </div>
            </section>
            <!-- Section Commentaire -->
            <section class="section">
                <h2>2. Commentaire</h2>
                <textarea class="commentaire" name="commentaire" rows="3"></textarea>
            </section>
            <div class="total-row">
                <p id="total-price">Total à payer : 0,00 €</p>
                <button type="submit" name="add_to_cart">Ajouter au panier</button>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div id="recapModal" class="modal" aria-hidden="true">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <div id="modalContent"> </div>
        </div>
    </div>
    
</body>
</html>
