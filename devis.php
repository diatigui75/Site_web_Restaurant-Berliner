<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Devis Gratuit - Avenir Rénovations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dossier_CSS/devis.css">
    <style>
        /* Styles pour la modale ovale */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 500px;
            border-radius: 50px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.5s ease-out;
        }

        .modal-icon {
            font-size: 3rem;
            color: #2ECC71;
            margin-bottom: 1rem;
        }

        .modal-title {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .modal-text {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .modal-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .modal-btn:hover {
            background: #2980b9;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Style pour le bouton de soumission */
        .submit-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Appel du header -->
    <?php include 'include_PHP/header1.php'; ?>
    <div class="banner">
        <h1>Votre devis travaux gratuit en quelques clics</h1>
    </div>
    <main class="form-container">
        <div class="form-content">
            <!-- Formulaire -->
            <div class="form-left">
                <h2>Devis : Échangeons sur votre projet !</h2>
                <form id="devisForm" action="Traitement_PHP/traitement_devis.php" method="post" onsubmit="showModal(event)">
                    <div class="form-group">
                        <label for="type_travaux">Type de travaux *</label>
                        <select id="type_travaux" name="type_travaux" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="renovation_energetique">Rénovation complète</option>
                            <option value="renovation_interieure">Carrelage</option>
                            <option value="renovation_exterieure">Maçonnerie</option>
                            <option value="amenagement_interieur">Menuiserie</option>
                            <option value="agrandissement">Nettoyage</option>
                            <option value="extension">Plomberie</option>
                            <option value="extension">Électricité</option>
                            <option value="extension">Peinture</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="prenom">Prénom *</label>
                            <input type="text" id="prenom" name="prenom" autocomplete="given-name" placeholder=" " required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" autocomplete="family-name" placeholder=" " required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse *</label>
                        <input type="text" id="adresse" name="adresse" autocomplete="street-address" placeholder=" " required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="code_postal">Code Postal *</label>
                            <input type="text" id="code_postal" name="code_postal" autocomplete="postal-code" placeholder=" " required>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville *</label>
                            <input type="text" id="ville" name="ville" autocomplete="address-level2" placeholder=" " required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="telephone">Téléphone *</label>
                            <input type="tel" id="telephone" name="telephone" autocomplete="tel" placeholder=" " required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" autocomplete="email" placeholder=" " required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="projet">Votre projet en quelques mots *</label>
                        <textarea id="projet" name="projet" placeholder=" " required></textarea>
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="donnees" name="donnees" required>
                        <label for="donnees">J'accepte que mes données soient collectées pour la réalisation d'un devis.</label>
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="confidentialite" name="confidentialite" required>
                        <label for="confidentialite">J'accepte la politique de confidentialité.</label>
                    </div>
                    <button type="submit" class="submit-btn">Je demande mon devis gratuit</button>
                </form>
            </div>
            <!-- Partie droite -->
            <div class="form-right">
                <h3>Pourquoi choisir Fanega Rénovations&nbsp;?</h3>
                <p><strong>Fanega Rénovations</strong> est une entreprise spécialisée dans la rénovation tous corps d'état. Nous vous accompagnons dans chacun de vos projets, qu'il s'agisse de rénovation intérieure ou extérieure, d'aménagement, d'agrandissement ou encore d'extension.</p>
                <p>Grâce à notre outil de suivi en ligne, vous avez une vision claire et transparente de l'avancement de votre chantier, depuis la demande de devis jusqu'à la livraison finale.</p>
                <p>Avec plus de <strong>10 ans d'expérience</strong>, Fanega Rénovations met son savoir-faire et son expertise au service de la réussite de vos projets.</p>
                <div class="reviews">
                    <div class="image-container">
                        <img src="Dossier_IMAGES/galerie7.jpg" alt="Avis clients">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Fenêtre modale de confirmation -->
    <div id="confirmationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="modal-title">Merci pour votre demande !</h2>
            <p class="modal-text">
                Votre devis pour <span id="modalTravauxType"></span> a bien été pris en compte.<br>
                Nous vous recontacterons sous <strong>24 à 48h</strong> pour échanger sur votre projet.
            </p>
            <button id="closeModal" class="modal-btn">OK</button>
        </div>
    </div>

    <!-- Section Contactez-Nous -->
    <?php include 'include_PHP/footer.php'; ?>

    <script>
        function showModal(event) {
            event.preventDefault(); // Empêche la soumission directe

            // Récupère le type de travaux sélectionné
            const travauxSelect = document.getElementById('type_travaux');
            const selectedOption = travauxSelect.options[travauxSelect.selectedIndex].text;
            document.getElementById('modalTravauxType').textContent = selectedOption;

            // Affiche la modale
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'flex';

            // Ferme la modale et soumet le formulaire
            document.getElementById('closeModal').onclick = function() {
                modal.style.display = 'none';
                event.target.submit(); // Soumet le formulaire après fermeture
            };
        }
    </script>
</body>
</html>
