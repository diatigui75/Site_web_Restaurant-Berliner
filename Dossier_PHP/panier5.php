<?php
session_start();
$prices = [
    'Frites'=> 2.00,
];
function calculateTotal(array $order, array $prices): float {
    $total = 0.0;

    // Ajoute le prix du kebab choisi
    if (!empty($order['kebab']) && isset($prices[$order['kebab']])) {
        $total += $prices[$order['kebab']];
    }

    // Ajoute le prix des frites
    if (!empty($order['frites']) && is_array($order['frites'])) {
        foreach ($order['frites'] as $frite) {
            if (isset($prices[$frite])) {
                $total += $prices[$frite];
            }
        }
    }

    // Ajoute le supplément sauces pour le kebab (la première gratuite, 0.20€ par sauce supplémentaire)
    if (!empty($order['sauces_kebab']) && is_array($order['sauces_kebab'])) {
        $sauceCount = count($order['sauces_kebab']);
        if ($sauceCount > 1) {
            $total += 0.20 * ($sauceCount - 1);
        }
    }

    // Ajoute le supplément sauces pour les frites (la première gratuite, 0.20€ par sauce supplémentaire)
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

// Ajout d'un kebab avec frites au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $order = [
        'kebab' => $_POST['kebab'] ?? '',
        'sauces_kebab' => isset($_POST['sauces_kebab']) ? (is_array($_POST['sauces_kebab']) ? $_POST['sauces_kebab'] : [$_POST['sauces_kebab']]) : [],
        'frites' => isset($_POST['frites']) ? (is_array($_POST['frites']) ? $_POST['frites'] : [$_POST['frites']]) : [],
        'sauces_frites' => isset($_POST['sauces_frites']) ? (is_array($_POST['sauces_frites']) ? $_POST['sauces_frites'] : [$_POST['sauces_frites']]) : [],
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
    <title>Commande de Frites</title>
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
            <h1>Commandez vos frites</h1>
            <p>Personnalisez vos frites en quelques clics</p>
        </header>
        <form method="post" action="" id="orderForm" class="grand_section">
            <!-- Inputs cachés pour stocker les sélections -->
            <input type="hidden" name="frites[]" id="selectedFrites" value="">
            <input type="hidden" name="sauces_frites[]" id="selectedSaucesFrites" value="">
            <!-- Section Frites -->
            <section class="section">
                <h2>1. Choisissez vos frites</h2>
                <div class="frites-options">
                    <div class="frites-option" data-value="Frites" data-price="2.00">Frites (+2,00 €)</div>
                </div>
            </section>
            <!-- Section Sauces pour les Frites -->
            <section class="section">
                <h2>2. Sauces pour les frites (la première est gratuite, 0,20 € pour chaque supplémentaire)</h2>
                <div class="sauce-frites-options">
                    <div class="sauce-option" data-value="Blanche">Blanche</div>
                    <div class="sauce-option" data-value="Harissa">Harissa</div>
                    <div class="sauce-option" data-value="Curry">Curry</div>
                    <div class="sauce-option" data-value="Algérienne">Algérienne</div>
                    <div class="sauce-option" data-value="Ketchup">Ketchup</div>
                    <div class="sauce-option" data-value="Sans sauce">Sans sauce</div>
                </div>
            </section>
            <!-- Section Commentaire -->
            <section class="section">
                <h2>3. Commentaire</h2>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tableau des prix
        const prices = {
            'Frites': 2.00,
        };

        // Sélection des frites
        const fritesOptions = document.querySelectorAll('.frites-option');
        fritesOptions.forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateTotalDisplay();
            });
        });

        // Sélection des sauces pour les frites
        const sauceFritesOptions = document.querySelectorAll('.sauce-frites-options .sauce-option');
        sauceFritesOptions.forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateTotalDisplay();
            });
        });

        // Fonction pour calculer le total
        function calculateTotalForm() {
            let total = 0;
            // Prix des frites sélectionnées
            const selectedFrites = document.querySelectorAll('.frites-option.selected');
            selectedFrites.forEach(frite => {
                const friteValue = frite.dataset.value;
                if (prices[friteValue] !== undefined) {
                    total += prices[friteValue];
                }
            });
            // Prix des sauces supplémentaires pour les frites
            const saucesFrites = document.querySelectorAll('.sauce-frites-options .sauce-option.selected');
            if (saucesFrites.length > 1) {
                total += 0.20 * (saucesFrites.length - 1);
            }
            return total;
        }

        // Met à jour l'affichage du total
        function updateTotalDisplay() {
            const total = calculateTotalForm();
            document.getElementById('total-price').textContent = `Total à payer : ${total.toFixed(2).replace('.', ',')} €`;
        }

        // Fonction pour collecter les sélections avant l'envoi du formulaire
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            // Vérifier si des frites sont sélectionnées
            const selectedFrites = document.querySelectorAll('.frites-option.selected');
            if (selectedFrites.length === 0) {
                alert("Veuillez choisir des frites.");
                e.preventDefault();
                return;
            }

            // Collecte des frites sélectionnées
            const selectedFritesValues = [];
            selectedFrites.forEach(option => {
                selectedFritesValues.push(option.dataset.value);
            });
            document.getElementById('selectedFrites').value = selectedFritesValues.join(',');

            // Collecte des sauces pour les frites
            const selectedSaucesFrites = [];
            document.querySelectorAll('.sauce-frites-options .sauce-option.selected').forEach(option => {
                selectedSaucesFrites.push(option.dataset.value);
            });
            document.getElementById('selectedSaucesFrites').value = selectedSaucesFrites.join(',');
        });

        // Gestion de l'ouverture/fermeture de la modale
        const openRecapBtn = document.getElementById('openRecap');
        const modal = document.getElementById('recapModal');
        const closeModalBtn = document.getElementById('closeModal');
        const modalContent = document.getElementById('modalContent');

        // Ouvrir la modale et charger le contenu du panier
        openRecapBtn.addEventListener('click', function() {
            fetch('?action=recap')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur lors de la récupération du panier.');
                    }
                    return response.text();
                })
                .then(html => {
                    modalContent.innerHTML = html;
                    modal.style.display = 'flex';
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    modalContent.innerHTML = '<p>Erreur lors du chargement du panier.</p>';
                    modal.style.display = 'flex';
                });
        });

        // Fermer la modale
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Fermer la modale si on clique en dehors
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Gestion des clics dans la modale
        modalContent.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-increase')) {
                const index = e.target.dataset.index;
                updateQuantity(index, 'increase');
            } else if (e.target.classList.contains('btn-decrease')) {
                const index = e.target.dataset.index;
                updateQuantity(index, 'decrease');
            } else if (e.target.classList.contains('btn-remove')) {
                const index = e.target.dataset.index;
                updateQuantity(index, 'remove');
            }
        });

        // Gestion de la modification manuelle de la quantité
        modalContent.addEventListener('change', function(e) {
            if (e.target.classList.contains('qty-input')) {
                const index = e.target.dataset.index;
                const quantity = e.target.value;
                updateQuantity(index, 'set_qty', quantity);
            }
        });

        // Fonction pour envoyer une requête AJAX
        function updateQuantity(index, action, quantity = null) {
            let body = `action=${action}&index=${index}`;
            if (quantity !== null) {
                body += `&quantity=${quantity}`;
            }
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetch('?action=recap')
                        .then(response => response.text())
                        .then(html => {
                            modalContent.innerHTML = html;
                        });
                }
            });
        }
    });
    </script>
</body>
</html>
