<!-- Section Contactez-Nous -->
<section id="contact" class="contact-section">
    <h2 class="contact-title">Contactez-nous</h2>
    <p class="contact-p">
        Nous sommes là pour répondre à toutes vos questions.
    </p>
    <div class="contact-container">
        <div class="contact-info">
            <h3>Parlons de Votre Projet</h3>
            <p>
                Nous serions ravis de discuter de vos besoins et de voir comment nous pouvons vous aider à atteindre vos objectifs.
            </p>
            <!-- Adresse -->
            <div class="info-item">
                <div class="info-icon">
                    <img src="Dossier_IMAGES/adresse.png" alt="Icône Adresse" class="custom-icon">
                </div>
                <div class="info-text">
                    <p><strong>Adresse</strong> <br>15 Avenue Stalingrad, Fresnes</p>
                </div>
            </div>
            <!-- Téléphone -->
            <div class="info-item">
                <div class="info-icon">
                    <img src="Dossier_IMAGES/telephone.png" alt="Icône Téléphone" class="custom-icon">
                </div>
                <div class="info-text">
                    <p><strong>Téléphone</strong> <br> +33 06 59 31 91 39</p>
                </div>
            </div>
            <!-- Email -->
            <div class="info-item">
                <div class="info-icon">
                    <img src="Dossier_IMAGES/email.png" alt="Icône Email" class="custom-icon">
                </div>
                <div class="info-text">
                    <p><strong>Email</strong> <br> sasfanega2@gmail.com <br> sasfanega@hotmail.com</p>
                </div>
            </div>
            <!-- Horaire -->
            <div class="info-item">
                <div class="info-icon">
                    <img src="Dossier_IMAGES/horaire.png" alt="Icône Horaire" class="custom-icon">
                </div>
                <div class="info-text">
                    <p><strong>Horaire</strong> <br> Disponible : 7j/7 à partir de 08h00 - 20h00</p>
                </div>
            </div>
        </div>
        <!-- Formulaire -->
        <form id="contactForm" class="contact-form" action="Traitement_PHP/traitement_message.php" method="post" onsubmit="showContactModal(event)">
            <h3>Message Rapide</h3>
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="votre@email.fr" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Décrivez votre projet..." required></textarea>
            </div>
            <button type="submit" class="submit-button">Envoyer le Message</button>
        </form>
    </div>
</section>

<!-- Fenêtre modale pour le formulaire de contact -->
<div id="contactConfirmationModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-paper-plane"></i>
        </div>
        <h2 class="modal-title">Message envoyé avec succès !</h2>
        <p class="modal-text">
            Nous avons bien reçu votre message, <span id="modalUserName"></span>.<br>
            Notre équipe vous répondra sous <strong>24 à 48h</strong> à l'adresse <span id="modalUserEmail"></span>.
        </p>
        <button id="closeContactModal" class="modal-btn">Fermer</button>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Fanega Rénovations</h4>
            <p>Votre partenaire de confiance pour tous vos projets de rénovation.</p>
        </div>
        <div class="footer-column">
            <h4>Services</h4>
            <ul>
                <li>Rénovation Complète</li>
                <li>Rénovation Extérieure / Intérieure</li>
                <li>Peinture / Carrelage / Menuiserie</li>
                <li>Nettoyage / Plomberie / Électricité</li>
                <li>Conseil & Expertise</li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Contact</h4>
            <p><i class="fas fa-phone-alt"></i> +33 06 59 31 91 39</p>
            <p><i class="fas fa-envelope"></i>sasfanega2@gmail.com</p>
            <p><i class="fas fa-map-marker-alt"></i> 15 Avenue Stalingrad, Fresnes</p>
        </div>
        <div class="footer-column">
            <h4>Suivez-nous</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>© 2025 Fanega Rénovations. Tous droits réservés.</p>
    </div>
</footer>

<!-- Styles pour la modale (à ajouter dans votre fichier CSS ou dans <head>) -->
<style>
    /* Styles communs pour les modales */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 2000;
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

    /* Style pour le bouton du formulaire de contact */
    .submit-button {
        background: #3498db;
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
    }

    .submit-button:hover {
        background: #2980b9;
    }
</style>

<!-- Script pour gérer la modale de contact -->
<script>
    function showContactModal(event) {
        event.preventDefault(); // Empêche la soumission directe

        // Récupère les valeurs du formulaire
        const userName = document.getElementById('name').value;
        const userEmail = document.getElementById('email').value;

        // Affiche les infos dans la modale
        document.getElementById('modalUserName').textContent = userName;
        document.getElementById('modalUserEmail').textContent = userEmail;

        // Affiche la modale
        const modal = document.getElementById('contactConfirmationModal');
        modal.style.display = 'flex';

        // Ferme la modale et soumet le formulaire
        document.getElementById('closeContactModal').onclick = function() {
            modal.style.display = 'none';
            event.target.submit(); // Soumet le formulaire après fermeture
        };
    }
</script>
