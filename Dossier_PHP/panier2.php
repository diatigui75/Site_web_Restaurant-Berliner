<?php
session_start();
$prices = [
    'Kebab Veau' => 9,
    'Kebab Poulet' => 9,
    'Kebab Végétarien' => 9,
    'Kebab Gourmand' => 9,
    'Frites'=> 2.00,
    'Chedar au poivre'=> 1.5,
    'Piment jalapenos'=> 1.5,
    'Supplement viande'=> 3.0
];
function calculateTotal(array $order, array $prices): float {
    $total = 0.0;

    // Ajoute le prix du kebab choisi
    if (!empty($order['kebab']) && isset($prices[$order['kebab']])) {
        $total += $prices[$order['kebab']];
    }

    // Ajoute le prix des accompagnements (frites et extras)
    foreach (['frites', 'extras'] as $category) {
        if (!empty($order[$category]) && is_array($order[$category])) {
            foreach ($order[$category] as $item) {
                if (isset($prices[$item])) {
                    $total += $prices[$item];
                }
            }
        }
    }

    // Ajoute le supplément sauces pour le kebab
    if (!empty($order['sauces_kebab']) && is_array($order['sauces_kebab'])) {
        $sauceCount = count($order['sauces_kebab']);
        if ($sauceCount > 1) {
            $total += 0.20 * ($sauceCount - 1);
        }
    }

    // Ajoute le supplément sauces pour les frites
    if (!empty($order['sauces_frites']) && is_array($order['sauces_frites'])) {
        $sauceCount = count($order['sauces_frites']);
        if ($sauceCount > 1) {
            $total += 0.20 * ($sauceCount - 1);
        }
    }

    return round($total, 2);
}

// Gestion des actions AJAX pour modifier le panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json; charset=utf-8');
    $action = $_POST['action'];
    $index = isset($_POST['index']) ? (int)$_POST['index'] : null;

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Logique pour augmenter, diminuer, supprimer ou définir la quantité
    if ($action === 'increase' && $index !== null && isset($_SESSION['panier'][$index])) {
        $_SESSION['panier'][$index]['quantite']++;
        echo json_encode(['success' => true]);
        exit;
    }

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

    if ($action === 'remove' && $index !== null && isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'set_qty' && $index !== null && isset($_SESSION['panier'][$index]) && isset($_POST['quantity'])) {
        $q = max(1, (int)$_POST['quantity']);
        $_SESSION['panier'][$index]['quantite'] = $q;
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'msg' => 'Action inconnue ou index invalide']);
    exit;
}

// Ajout d'un article au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $order = [
        'kebab' => $_POST['kebab'] ?? '',
        'sauces_kebab' => isset($_POST['sauces_kebab']) ? (is_array($_POST['sauces_kebab']) ? $_POST['sauces_kebab'] : [$_POST['sauces_kebab']]) : [],
        'frites' => isset($_POST['frites']) ? (is_array($_POST['frites']) ? $_POST['frites'] : [$_POST['frites']]) : [],
        'sauces_frites' => isset($_POST['sauces_frites']) ? (is_array($_POST['sauces_frites']) ? $_POST['sauces_frites'] : [$_POST['sauces_frites']]) : [],
        'extras' => isset($_POST['extras']) ? (is_array($_POST['extras']) ? $_POST['extras'] : [$_POST['extras']]) : [],
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
            <input type="hidden" name="frites[]" id="selectedFrites" value="">
            <input type="hidden" name="sauces_frites[]" id="selectedSaucesFrites" value="">
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
            <!-- Section Frites -->
            <section class="section">
                <h2>3. Choisissez vos frites</h2>
                <div class="frites-options">
                    <div class="frites-option" data-value="Frites" data-price="2.00">Frites (+2,00 €)</div>
                </div>
            </section>
            <!-- Section Sauces pour les Frites -->
            <section class="section">
                <h2>4. Sauces pour les frites (la première est gratuite, 0,20 € pour chaque supplémentaire)</h2>
                <div class="sauce-frites-options">
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
                <h2>5. Suppléments</h2>
                <div class="extra-options">
                    <div class="extra-option" data-value="Chedar au poivre" data-price="1.5">Chedar au poivre (+1,5 €)</div>
                    <div class="extra-option" data-value="Piment jalapenos" data-price="1.5">Piment jalapenos (+1,5 €)</div>
                    <div class="extra-option" data-value="Supplement viande" data-price="3">Supplement viande (+3 €)</div>
                </div>
            </section>
            <!-- Section Commentaire -->
            <section class="section">
                <h2>6. Commentaire</h2>
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
