<?php
// Démarre la session PHP pour pouvoir stocker le panier dans $_SESSION
session_start();
$prices = [
    'Kebab Veau' => 9,
    'Kebab Poulet' => 9,
    'Kebab Végétarien' => 9,
    'Kebab Gourmand' => 9,
    'Chedar au poivre'=> 1.5,
    'Piment jalapenos'=> 1.5,
    'Supplement viande'=> 3.0
];
/**
 * Fonction pour calculer le total d'une commande
 */
function calculateTotal(array $order, array $prices): float {
    $total = 0.0;
    // Ajoute le prix du kebab choisi
    if (!empty($order['kebab']) && isset($prices[$order['kebab']])) {
        $total += $prices[$order['kebab']];
    }
    // Ajoute le prix des extras
    if (!empty($order['extras']) && is_array($order['extras'])) {
        foreach ($order['extras'] as $item) {
            if (isset($prices[$item])) {
                $total += $prices[$item];
            }
        }
    }
    // Ajoute le supplément sauces pour le kebab (la première gratuite, 0.20€ par sauce en plus)
    if (!empty($order['sauces_kebab']) && is_array($order['sauces_kebab'])) {
        $sauceCount = count($order['sauces_kebab']);
        if ($sauceCount > 1) {
            $total += 0.20 * ($sauceCount - 1);
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
            echo "<p><strong>" . htmlspecialchars($item['kebab']) . "</strong></p>";
            if (!empty($item['sauces_kebab'])) {
                echo "<p><strong>Sauces pour le kebab :</strong> " . implode(", ", array_map('htmlspecialchars', $item['sauces_kebab'])) . "</p>";
            }
            if (!empty($item['extras'])) {
                echo "<p><strong>Suppléments :</strong> " . implode(", ", array_map('htmlspecialchars', $item['extras'])) . "</p>";
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
    $saucesKebab = isset($_POST['sauces_kebab']) && !empty($_POST['sauces_kebab']) ? $_POST['sauces_kebab'] : [];
    $extras = isset($_POST['extras']) && !empty($_POST['extras']) ? $_POST['extras'] : [];

    $order = [
        'kebab' => $_POST['kebab'] ?? '',
        'sauces_kebab' => is_array($saucesKebab) ? $saucesKebab : [$saucesKebab],
        'extras' => is_array($extras) ? $extras : [$extras],
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
    <title>Personnalisez votre Kebab</title>
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
            <h1>Personnalisez votre Kebab</h1>
            <p>Créez votre kebab idéal en quelques clics</p>
        </header>
        <form method="post" action="" id="orderForm" class="grand_section">
            <!-- Inputs cachés pour stocker les sélections -->
            <input type="hidden" name="kebab" id="selectedKebab" value="">
            <input type="hidden" name="sauces_kebab[]" id="selectedSaucesKebab" value="">
            <input type="hidden" name="extras[]" id="selectedExtras" value="">
            <!-- Section Kebab -->
            <section class="section">
                <h2>1. Choisissez votre kebab fait maison</h2>
                <div class="kebab-options">
                    <div class="kebab-option" data-value="Kebab Veau" data-price="9">
                        <h3>Kebab Veau</h3>
                        <p>Viande tendre</p>
                        <div class="price">9 €</div>
                    </div>
                    <div class="kebab-option" data-value="Kebab Poulet" data-price="9">
                        <h3>Kebab Poulet</h3>
                        <p>100% filet de poulet</p>
                        <div class="price">9 €</div>
                    </div>
                    <div class="kebab-option" data-value="Kebab Végétarien" data-price="9">
                        <h3>Kebab Végétarien</h3>
                        <p>Seitan et légumes frais</p>
                        <div class="price">9 €</div>
                    </div>
                    <div class="kebab-option" data-value="Kebab Gourmand" data-price="9">
                        <h3>Kebab Gourmand</h3>
                        <p>Viande de Veau et Poulet</p>
                        <div class="price">9 €</div>
                    </div>
                </div>
            </section>
            <!-- Section Sauces pour le Kebab -->
            <section class="section">
                <h2>2. Sauces pour le kebab (la première est gratuite, 0,20 € pour chaque supplémentaire)</h2>
                <div class="sauce-kebab-options">
                    <div class="sauce-option" data-value="Blanche">Blanche</div>
                    <div class="sauce-option" data-value="Harissa">Harissa</div>
                    <div class="sauce-option" data-value="Curry">Curry</div>
                    <div class="sauce-option" data-value="Algérienne">Algérienne</div>
                    <div class="sauce-option" data-value="Ketchup">Ketchup</div>
                    <div class="sauce-option" data-value="Sans sauce">Sans sauce</div>
                </div>
            </section>
            <!-- Section Suppléments -->
            <section class="section">
                <h2>3. Suppléments</h2>
                <div class="extra-options">
                    <div class="extra-option" data-value="Chedar au poivre" data-price="1.5">Chedar au poivre (+1,5 €)</div>
                    <div class="extra-option" data-value="Piment jalapenos" data-price="1.5">Piment jalapenos (+1,5 €)</div>
                    <div class="extra-option" data-value="Supplement viande" data-price="3">Supplement viande (+3 €)</div>
                </div>
            </section>
            <!-- Section Commentaire -->
            <section class="section">
                <h2>4. Commentaire</h2>
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
