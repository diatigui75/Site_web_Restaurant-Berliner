<!DOCTYPE html>
<html lang="fr">
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanega - Rénovation de Bâtiments d'Excellence</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dossier_CSS/styles.css">
    <style>
        /* ===== STYLE DE LA MODALE OVALE ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 3000;
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
            position: relative;
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
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Style pour le bouton de la modale */
        .confirm-button {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 3rem;
        }

        .confirm-button:hover {
            background: #2980b9;
        }

        #modal-devis {
            margin-top: 20px;
            /* espace entre texte et bouton */
            display: flex;
            justify-content: center;
        }


        /* Style pour les modales existantes (services) */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            animation: fadeIn 0.5s;
        }

        .close,
        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close-modal:hover {
            color: black;
        }
    </style>
</head>

<body>
    <!-- Appel du header -->
    <?php include 'include_PHP/header.php'; ?>

    <!-- Section Accueil (Slideshow) -->
    <main id="accueil">
        <div class="slideshow-container">
            <div class="slide fade">
                <img src="Dossier_IMAGES/house.jpg" alt="Maison 1">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house1.jpg" alt="Maison 2">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house2.jpg" alt="Maison 3">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house3.jpg" alt="Maison 4">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house4.jpg" alt="Maison 5">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house5.jpg" alt="Maison 6">
            </div>
            <div class="slide fade">
                <img src="Dossier_IMAGES/house6.jpg" alt="Maison 7">
            </div>
        </div>
        <div class="hero-content">
            <h2>Rénovation de Bâtiments d'Excellence</h2>
            <p>Expertise technique, innovation et accompagnement personnalisé pour tous vos projets de rénovation.</p>
            <div class="hero-buttons">
                <a href="devis.php" class="button primary">Devis Gratuit</a>
                <a href="#galerie" class="button secondary">Voir Portfolio</a>
            </div>
        </div>
    </main>

    <!-- Section Services -->
    <section id="services" class="carousel-section">
        <h2>NOS SERVICES</h2>
        <p class="accroche">Choisissez le service qui vous intéresse avec des explications détaillées</p>
        <div class="galerie-projets">
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/renovation.jpg');">
                <div class="infos-projet">
                    <h3>Rénovation complète</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/carrelage.jpg');">
                <div class="infos-projet">
                    <h3>Carrelage</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/maçon.jpg');">
                <div class="infos-projet">
                    <h3>Maçonnerie</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/menusier.jpg');">
                <div class="infos-projet">
                    <h3>Menuiserie</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/nettoyage.jpg');">
                <div class="infos-projet">
                    <h3>Nettoyage</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/Plomberie.jpg');">
                <div class="infos-projet">
                    <h3>Plomberie</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/electricite.jpg');">
                <div class="infos-projet">
                    <h3>Électricité</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
            <div class="carte-projet" style="background-image: url('Dossier_IMAGES/peinture1.jpg');">
                <div class="infos-projet">
                    <h3>Peinture</h3>
                    <button class="bouton-projet">En savoir plus</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Galerie -->
    <section id="galerie" class="carousel-section">
        <h2>NOTRE GALERIE</h2>
        <p class="accroche">Explorez la qualité de nos réalisations</p>
        <div class="carousel-container">
            <div class="carousel-track" id="carousel-track">
                <div class="card" style="background-image: url('Dossier_IMAGES/galerie1.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 1</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/galerie2.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 2</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/galerie3.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 3</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/cuisine1.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 4</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/salle_de_bain2.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 5</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/galerie4.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 6</h3>
                    </div>
                </div>

                <div class="card" style="background-image: url('Dossier_IMAGES/galerie6.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 7</h3>
                    </div>
                </div>
                <div class="card" style="background-image: url('Dossier_IMAGES/galerie7.jpg');">
                    <div class="card-overlay">
                        <h3>Projet 8</h3>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Section À Propos -->
    <section id="apropos" class="history-section">
        <div class="history-content">
            <h2>Notre histoire</h2>
            <p>
                Fondée en 2017, Fanega est une entreprise générale du bâtiment située à Fresnes. Quelle que soit la nature de votre projet, nous mettons à votre service des solutions techniques fiables et adaptées, dans le respect de vos délais et de votre budget.
            </p>
            <p>
                Notre priorité est de garantir la qualité de chaque réalisation, en alliant expertise et professionnalisme. Chaque projet reflète notre savoir-faire et notre volonté d'accompagner nos clients avec rigueur et efficacité.
            </p>
            <p>
                Nous nous engageons à offrir des prestations sur mesure, en mobilisant les compétences et les équipements nécessaires, même dans les environnements les plus exigeants.
            </p>
        </div>
        <div class="history-stats">
            <div class="stats-card">
                <div class="stat-item">
                    <span class="stat-number blue">400+</span>
                    <span class="stat-label">Clients Satisfaits</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number purple">10+</span>
                    <span class="stat-label">Années d'Expérience</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number green">50+</span>
                    <span class="stat-label">Projets Réalisés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number orange">24/7</span>
                    <span class="stat-label">Support Client</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Modale pour Prendre Rendez-vous -->
    <div id="rendezVousModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Prendre Rendez-vous</h2>
            <form id="rendezVousForm" method="post" action="Traitement_PHP/traitement_rendez-vous.php">
                <div class="form-group">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" autocomplete="email" placeholder="Email" required>
                    <input type="tel" name="telephone" placeholder="Téléphone"
                        required pattern="^0[1-9][0-9]{8}$"
                        title="Numéro invalide. Exemple : 0612345678">
                </div>
                <div class="form-group">
                    <select name="type_rdv" required>
                        <option value="">Type de rendez-vous</option>
                        <option value="devis">Devis</option>
                        <option value="consultation">Consultation</option>
                        <option value="suivi">Suivi de projet</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" name="date_rdv" required>
                    <input type="time" name="heure_rdv" min="08:00" max="18:00" required>
                </div>
                <div class="form-group">
                    <textarea name="motif" placeholder="Motif du rendez-vous / Questions particulières" rows="4" required></textarea>
                </div>
                <button type="submit" class="confirm-button">Confirmer le Rendez-vous</button>
            </form>
        </div>
    </div>

    <!-- Modale pour les services -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal-title">Rénovation complète</h3>
            <div id="modal-description"></div>
            <div id="modal-devis"></div>
        </div>
    </div>

    <!-- Modale de confirmation ovale pour rendez-vous -->
    <div id="confirmationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h2 class="modal-title">Rendez-vous confirmé !</h2>
            <p class="modal-text">
                Votre demande pour un <strong><span id="modalRdvType"></span></strong> a bien été enregistrée.<br>
                Nous vous contacterons sous <strong>24h</strong> pour confirmer les détails.
            </p>
            <button id="closeConfirmationModal" class="modal-btn">OK</button>
        </div>
    </div>

    <!-- Section Contactez-Nous -->
    <?php include 'include_PHP/footer.php'; ?>

    <!-- Scripts -->
    <script>
        // ===== SLIDESHOW =====
        let slideIndex = 0;

        function showBackgroundSlides() {
            const slides = document.querySelectorAll(".slide");
            slides.forEach(slide => slide.style.opacity = "0");
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].style.opacity = "1";
            setTimeout(showBackgroundSlides, 5000);
        }
        showBackgroundSlides();

        // ===== CARROUSEL GALERIE =====
        const track = document.getElementById("carousel-track");
        if (track) {
            const cards = Array.from(track.children);
            cards.forEach(card => track.appendChild(card.cloneNode(true)));
            track.addEventListener("mouseenter", () => track.style.animationPlayState = "paused");
            track.addEventListener("mouseleave", () => track.style.animationPlayState = "running");
        }

        // ===== MODALES SERVICES =====
        const serviceDetails = {
            "Rénovation complète": {
                description: `
                    Nous prenons en charge l'intégralité de vos travaux, du sol au plafond.
                    Notre mission est de <strong>réinventer vos espaces</strong> en respectant vos goûts, vos besoins et vos contraintes.<br><br>
                    ✔️ Accompagnement personnalisé, de la conception à la réalisation finale.<br>
                    ✔️ Travaux clés en main : démolition, gros œuvre, plomberie, électricité, isolation, menuiserie et finitions.<br>
                    ✔️ Résultat garanti : un lieu moderne, fonctionnel, esthétique et durable.
                `,
                showDevisButton: true
            },
            "Carrelage": {
                description: `
                    Apportez <strong>élégance et robustesse</strong> à vos sols et murs grâce à notre savoir-faire.<br><br>
                    ✔️ Large choix de matériaux : grès cérame, faïence, mosaïque, carreaux décoratifs.<br>
                    ✔️ Pose professionnelle avec précision millimétrée.<br>
                    ✔️ Résistance et durabilité pour intérieurs et extérieurs.
                `,
                showDevisButton: true
            },
            "Maçonnerie": {
                description: `
                    Réalisation d'ouvrages solides et esthétiques, en construction neuve ou rénovation.<br><br>
                    ✔️ Création et rénovation de murs porteurs, cloisons, dalles et fondations.<br>
                    ✔️ Utilisation de matériaux fiables (parpaings, briques, pierre).<br>
                    ✔️ Respect des normes de sécurité et finitions propres.
                `,
                showDevisButton: true
            },
            "Menuiserie": {
                description: `
                    Conception et installation sur mesure d'éléments en bois et composites.<br><br>
                    ✔️ Escaliers, placards, portes, fenêtres et meubles personnalisés.<br>
                    ✔️ Solutions modernes ou traditionnelles selon vos envies.<br>
                    ✔️ Bois massif, MDF, aluminium et finitions haut de gamme.
                `,
                showDevisButton: true
            },
            "Nettoyage": {
                description: `
                    Après vos travaux, retrouvez un espace <strong>propre et prêt à vivre</strong>.<br><br>
                    ✔️ Déblaiement et évacuation des déchets.<br>
                    ✔️ Nettoyage approfondi des surfaces et sols.<br>
                    ✔️ Désinfection avec produits respectueux de l'environnement.
                `,
                showDevisButton: true
            },
            "Plomberie": {
                description: `
                    Installation, entretien et réparation de vos équipements sanitaires.<br><br>
                    ✔️ Création ou rénovation de réseaux d'eau potable et d'évacuation.<br>
                    ✔️ Dépannage rapide : fuites, robinets, canalisations bouchées.<br>
                    ✔️ Pose de douches, baignoires, éviers, chauffe-eau modernes.
                `,
                showDevisButton: true
            },
            "Électricité": {
                description: `
                    Sécurisation et modernisation de vos installations électriques.<br><br>
                    ✔️ Mise en conformité selon les normes en vigueur.<br>
                    ✔️ Installation complète ou rénovation du réseau.<br>
                    ✔️ Intégration de solutions modernes : LED, domotique, tableaux intelligents.
                `,
                showDevisButton: true
            },
            "Peinture": {
                description: `
                    Apportez couleur et personnalité à vos espaces intérieurs et extérieurs.<br><br>
                    ✔️ Préparation minutieuse (ponçage, sous-couche).<br>
                    ✔️ Large palette de peintures : acrylique, glycéro, écologique.<br>
                    ✔️ Finitions soignées, résistantes et esthétiques.
                `,
                showDevisButton: true
            }
        };

        // Gestion des modales de services
        document.querySelectorAll('.bouton-projet').forEach(button => {
            button.addEventListener('click', () => {
                const title = button.parentElement.querySelector('h3').textContent;
                const detail = serviceDetails[title];
                document.getElementById('modal-title').textContent = title;
                document.getElementById('modal-description').innerHTML = detail.description;
                document.getElementById('modal-devis').innerHTML =
                    detail.showDevisButton ? `<a href="devis.php" class="button primary">Faire un devis</a>` : "";
                document.getElementById('modal').style.display = 'block';
            });
        });

        // Fermeture des modales
        document.querySelectorAll('.close, .close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.closest('.modal').style.display = 'none';
            });
        });

        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });

        // ===== MODALE RENDEZ-VOUS =====
        const prendreRendezVousBtn = document.getElementById('prendreRendezVousBtn');
        const rendezVousModal = document.getElementById('rendezVousModal');

        if (prendreRendezVousBtn) {
            prendreRendezVousBtn.addEventListener('click', (e) => {
                e.preventDefault();
                rendezVousModal.style.display = 'block';
            });
        }

        // Gestion du formulaire de rendez-vous
        document.getElementById('rendezVousForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = "Envoi en cours...";

            const formData = new FormData(this);
            const rdvType = this.querySelector('select[name="type_rdv"]').value;
            const typeNames = {
                'devis': 'un devis',
                'consultation': 'une consultation',
                'suivi': 'un suivi de projet'
            };

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    document.getElementById('modalRdvType').textContent = typeNames[rdvType] || 'un rendez-vous';
                    const confirmationModal = document.getElementById('confirmationModal');
                    confirmationModal.style.display = 'flex';

                    document.getElementById('closeConfirmationModal').onclick = function() {
                        confirmationModal.style.display = 'none';
                        document.getElementById('rendezVousForm').reset();
                        submitButton.disabled = false;
                        submitButton.textContent = "Confirmer le Rendez-vous";
                        rendezVousModal.style.display = 'none';
                    };
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    const confirmationModal = document.getElementById('confirmationModal');
                    confirmationModal.querySelector('.modal-icon').innerHTML =
                        '<i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i>';
                    confirmationModal.querySelector('.modal-title').textContent = "Erreur d'envoi";
                    confirmationModal.querySelector('.modal-text').innerHTML =
                        "Une erreur est survenue. Veuillez réessayer ou nous contacter au <strong>06 59 31 91 39</strong>.";
                    confirmationModal.style.display = 'flex';

                    document.getElementById('closeConfirmationModal').onclick = function() {
                        confirmationModal.style.display = 'none';
                        submitButton.disabled = false;
                        submitButton.textContent = "Confirmer le Rendez-vous";
                    };
                });
        });

        // ===== NAVIGATION FLUIDE =====
        document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Origine BK</title>
    <link rel="stylesheet" href="Dossier_CSS/styles.css">
    <script src="Dossier_JS/script.js"></script>
</head>
<body>
    <!-- Page d'accueil -->
    <header>
        <div class="logo"></div>
        <nav>
            <ul>
                <!-- Liens de navigation vers les sections de la page -->
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#a-propos">À propos</a></li>
                <li><a href="#galerie">Galerie</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
     <!-- Contenu principal de la page -->
    <main>
         <!-- Section Hero avec vidéo en arrière-plan -->
        <section  id="accueil" class="hero">
            <video autoplay muted loop id="background-video">
                <source src="Dossier_images/video3.mp4" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
            <div class="hero-content">
                <h1>Cuisine française de saison, ancrée dans ses origines</h1>
                <p>Une expérience culinaire authentique au cœur de la tradition française</p>
                <div class="buttons">
                    <!-- Boutons pour découvrir le menu et réserver une table -->
                    <button class="menu-btn" id="discoverMenuBtn">Découvrir notre menu</button>
                    <button class="reserver-table-btn" id="reserveTableBtn">Réserver une table</button>
                </div>
            </div>
        </section>

    </main>

    <!-- Section Menu -->
<section id="menu" class="menu-section">
    <h1 class="menu-title">Notre Menu</h1>
    <p class="menu-subtitle">Des produits frais et de saison, cuisinés avec passion</p>
    <div class="menu-grid">
          <!-- Chaque carte de menu est un formulaire qui envoie les données vers un fichier PHP -->
           <!-- Carte 1 -->
            <form action="Dossier_PHP/panier1.php" method="POST" class="menu-card-form">
                  <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Kebab Frites Boisson</h3>
                        <p class="price">12,5€</p>
                    </div>
                    <input type="hidden" name="item" value="Kebab Frites Boisson">
                </div>
            </form>

            <!-- Carte 2 -->
            <form action="Dossier_PHP/panier2.php" method="POST" class="menu-card-form">
                    <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Kebab Frites</h3>
                        <p class="price">11€</p>
                    </div>
                    <input type="hidden" name="item" value="Kebab Frites">
                </div>
            </form>

            <!-- Carte 3 -->
            <form action="Dossier_PHP/panier3.php" method="POST" class="menu-card-form">
                    <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Kebab Boisson</h3>
                        <p class="price">11€</p>
                    </div>
                    <input type="hidden" name="item" value="Kebab Boisson">
                </div>
            </form>

            <!-- Carte 4 -->
            <form action="Dossier_PHP/panier4.php" method="POST" class="menu-card-form">
                    <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Kebab</h3>
                        <p class="price">9€</p>
                    </div>
                    <input type="hidden" name="item" value="Kebab">
                </div>
            </form>

            <!-- Carte 5 -->
            <form action="Dossier_PHP/panier5.php" method="POST" class="menu-card-form">
                    <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Frites</h3>
                        <p class="price">3€</p>
                    </div>
                    <input type="hidden" name="item" value="Frites">
                </div>
            </form>

            <!-- Carte 6 -->
            <form action="Dossier_PHP/panier6.php" method="POST" class="menu-card-form">
                    <div class="menu-card" style="background-image: url('Dossier_images/image3.jpg');" onclick="this.closest('form').submit();">
                    <button type="submit" class="add-button">ADD</button>
                    <div class="menu-card-info">
                        <h3>Boissons</h3>
                        <p class="price">2,5€</p>
                    </div>
                    <input type="hidden" name="item" value="Boissons">
                </div>
            </form>
        </div>
</section>

    <!-- Section de Réservation -->
<div id="reservation" class="reservation-container">
    <header class="reservation-header">
        <h1>Réservation</h1>
        <p>Réservez votre table pour une expérience gastronomique inoubliable</p>
    </header>
       <!-- Formulaire de réservation -->
    <form class="reservation-form" action="reservation.php" method="POST">
        <div class="form-group">
            <label for="full_name">Nom complet</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label for="time">Heure</label>
            <input type="time" id="time" name="time" required>
        </div>
        <div class="form-group">
            <label for="guests">Nombre de personnes</label>
            <select id="guests" name="guests" required>
                <option value="1">1 personne</option>
                <option value="2">2 personnes</option>
                <option value="3">3 personnes</option>
                <option value="4">4 personnes et plus </option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label for="special_requests">Demandes spéciales (optionnel)</label>
            <textarea id="special_requests" name="special_requests"></textarea>
        </div>
        <input type="hidden" name="from_index" value="1">
        <button type="submit" class="confirm-btn">Confirmer la réservation</button>
    </form>
    
</div>

     <!-- Section À propos -->
    <section id="a-propos" class="about-container">
        <div class="about-header">
            <h1>À propos d'Origine</h1>
            <h1>BK</h1>
            <div class="red-line"></div>
        </div>
        <div class="about-content">
            <p>Fondé en 2018, Origine BK est né d'une <br>
                passion pour la cuisine française <br>
                authentique et d'un profond respect pour <br>
                les produits de saison.</p>
            <p>Notre philosophie est simple : proposer <br>
               une cuisine qui honore ses origines tout <br>
               en apportant une touche de modernité. Chaque <br> 
               plat raconte une histoire, celle de nos terroirs <br>
               et de notre patrimoine culinaire.</p>
            <p>Nous travaillons exclusivement avec des <br>
               producteurs locaux qui partagent nos valeurs.</p>
        </div>
        <div class="since-badge">
            <p>DEPUIS</p>
            <p>2018</p>
        </div>
    </section>

     <!-- Section Galerie -->
    <section id="galerie" class="gallery-container">
        <h1 class="gallery-title">Notre Galerie</h1>
        <p class="gallery-subtitle">Découvrez l'ambiance et les créations d'Origine BK</p>
        <div class="gallery-grid">
            <!-- Exemple d'image -->
            <div class="gallery-item">
                <img src="Dossier_images/image2.jpg" alt="Plat signature">
                <p>Degustez</p>
            </div>
            <!-- Exemple d'image -->
            <div class="gallery-item">
                <img src="Dossier_images/image3.jpg" alt="Salle du restaurant">
                <p>Galette ou Pain</p>
            </div>
            <!-- Exemple d'image -->
            <div class="gallery-item">
                <img src="Dossier_images/image4.jpg" alt="Salle du restaurant">
                <p>Kebab fait maison</p>
            </div>

           <div class="gallery-item">
                <img src="Dossier_images/image5.jpg" alt="Plat signature">
                <p>Legumes</p>
            </div>

            <!-- Exemple d'image -->
            <div class="gallery-item">
                <img src="Dossier_images/image6.jpg" alt="Salle du restaurant">
                <p>Veau</p>
            </div>
            <!-- Exemple d'image -->
            <div class="gallery-item">
                <img src="Dossier_images/image7.jpg" alt="Salle du restaurant">
                <p>Charbon de bois</p>
            </div>

        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact" class="contact-section">
        <h1 class="contact-title">Contact</h1>
        <p class="contact-subtitle">Nous sommes à votre disposition pour toute information</p>

        <div class="contact-container">
            <div class="contact-info">
                <h2>Adresse</h2>
                <p>19 Rue du Mirail</p>
                <p>33000 Bordeaux, France</p>

                <h2>Horaires d'ouverture</h2>
                <p><strong>Ouvert 7j/7</strong></p>
                <p><strong>Lundi - Dimanche</strong> : 12h00 - 23h30</p>
                <h2>Contact</h2>
                <p>+33 9 79 14 48 70</p>
                <p>contact@originebk.fr</p>

                <h2>Suivez-nous</h2>
                <div class="social-icons">
                    <a href="https://www.facebook.com/share/1BCZGDUjrH/?mibextid=wwXIfr"><img src="Dossier_images/facebook.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/origine_bk/?utm_source=ig_embed"><img src="Dossier_images/insta.jpeg" alt="Instagram"></a>
                </div>
            </div>

            <div class="contact-map">
                <!-- Intégrez ici une carte Google Maps ou une image de carte -->
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2829.3787345683345!2d-0.5739111242762905!3d44.83421987525191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527654d4abb45%3A0xd5fba47922f7aa99!2sOrigine%20BK%20-%20Berliner%20kebab!5e0!3m2!1sfr!2sfr!4v1752239201185!5m2!1sfr!2sfr" referrerpolicy="no-referrer-when-downgrade">
               </iframe>
            </div>

            <div class="contact-form">
                <h2>Envoyez-nous un message</h2>
                <form method="post" action="message.php">
                    <div class="form-group">
                        <label for="Nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="Sujet">Sujet</label>
                        <input type="text" id="sujet" name="sujet" required>
                    </div>
                    <div class="form-group">
                        <label for="Message">Message</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Envoyer</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Pied de page -->
   <footer class="footer">
    <div class="footer-logo">
        <img src="Dossier_images/Berliner.png" alt="Origine BK Logo">
        <p>© 2023 Origine BK. Tous droits réservés.</p>
    </div>

    <div class="footer-location">
        <h4>📍 Notre adresse</h4>
        <p>42 Rue de la Gastronomie, 75001 Paris, France</p>
    </div>

    <div class="footer-links">
        <a href="#">Mentions légales</a>
        <a href="#">Politique de confidentialité</a>
    </div>
  </footer>

</body>
</html>
>>>>>>> 71df9fe (Ajout du site web fini)
