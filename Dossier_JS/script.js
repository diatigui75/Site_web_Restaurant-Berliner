<<<<<<< HEAD
// --- Défilement fluide pour les liens de navigation ---
document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// --- Slideshow principal (arrière-plan) ---
let slideIndex = 0;
function showBackgroundSlides() {
    const slides = document.getElementsByClassName("slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.opacity = "0";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1; }
    slides[slideIndex - 1].style.opacity = "1";
    setTimeout(showBackgroundSlides, 5000);
}
showBackgroundSlides();

// --- Carrousel horizontal de cartes (scroll infini) ---
const track = document.getElementById("carousel-track");
if (track) {
    const cards = Array.from(track.children);
    cards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });
    track.addEventListener("mouseenter", () => {
        track.style.animationPlayState = "paused";
    });
    track.addEventListener("mouseleave", () => {
        track.style.animationPlayState = "running";
    });
}

// --- Gestion des modales de services ---
const buttons = document.querySelectorAll('.bouton-projet');
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalDescription = document.getElementById('modal-description');
const closeBtn = document.querySelector('.close');

// Définir les descriptions pour chaque service
const serviceDescriptions = {
    "Rénovation complète": "Nous proposons une rénovation complète de votre habitat, de la structure aux finitions, en passant par l’isolation et l’aménagement intérieur. Notre équipe s’occupe de tout, pour un résultat clé en main.",
    "Carrelage": "Pose de carrelage sur mesure, pour sols et murs, avec un large choix de matériaux et de motifs. Nous garantissons une finition impeccable et durable.",
    "Maçonnerie": "Travaux de maçonnerie pour la construction, la réparation ou l’aménagement de murs, fondations et structures en béton. Nous intervenons pour tous types de projets, petits ou grands.",
    "Menuiserie": "Fabrication et pose de menuiseries intérieures et extérieures : portes, fenêtres, escaliers, placards, etc. Nous travaillons le bois, l’aluminium et le PVC.",
    "Nettoyage": "Nettoyage professionnel après travaux ou en entretien régulier. Nous utilisons des produits adaptés et des techniques respectueuses de l’environnement.",
    "Plomberie": "Installation, réparation et entretien de vos réseaux d’eau, chauffage et sanitaires. Nous intervenons pour les particuliers et les professionnels.",
    "Électricité": "Mise aux normes, installation électrique complète, dépannage et domotique. Nos électriciens certifiés garantissent votre sécurité et votre confort.",
    "Peinture": "Peinture intérieure et extérieure, avec préparation des supports et finitions soignées. Nous vous conseillons sur les couleurs et les types de peinture adaptés à vos besoins."
};

// Ajouter un événement à chaque bouton de service
buttons.forEach(button => {
    button.addEventListener('click', () => {
        const title = button.parentElement.querySelector('h3').textContent;
        modalTitle.textContent = title;
        modalDescription.textContent = serviceDescriptions[title];
        modal.style.display = 'block';
    });
});

// Fermer la modale des services
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Fermer la modale des services si on clique en dehors
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// --- Gestion de la modale "Prendre Rendez-vous" ---
const prendreRendezVousBtn = document.getElementById('prendreRendezVousBtn');
const rendezVousModal = document.getElementById('rendezVousModal');
const closeRendezVousModalBtn = document.querySelector('#rendezVousModal .close-modal');

// Ouvrir la modale "Prendre Rendez-vous"
prendreRendezVousBtn.addEventListener('click', (e) => {
    e.preventDefault();
    rendezVousModal.style.display = 'block';
});

// Fermer la modale "Prendre Rendez-vous"
closeRendezVousModalBtn.addEventListener('click', () => {
    rendezVousModal.style.display = 'none';
});

// Fermer la modale si on clique en dehors
window.addEventListener('click', (event) => {
    if (event.target === rendezVousModal) {
        rendezVousModal.style.display = 'none';
    }
});

=======
document.addEventListener('DOMContentLoaded', function() {
    // 1. Effets de survol et défilement fluide pour la navigation
    const navLinks = document.querySelectorAll('nav ul li a');
    const colors = ['#FF5733', '#FF5733', '#FF5733', '#FF5733', '#FF5733'];

    navLinks.forEach((link, index) => {
        // Effet de survol
        link.addEventListener('mouseenter', function() {
            this.style.backgroundColor = colors[index];
            this.style.transform = 'scale(1.1)';
        });
        link.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'scale(1)';
        });
        // Défilement fluide vers la section ciblée
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // 2. Gestion des boutons "Découvrir notre menu" et "Réserver une table"
    const buttons = [
        { id: 'discoverMenuBtn', target: 'menu' },
        { id: 'reserveTableBtn', target: 'reservation' },
        { id: 'reserverBtn', target: 'reservation' }
    ];

    buttons.forEach(btn => {
        const button = document.getElementById(btn.id);
        if (button) {
            button.addEventListener('click', function() {
                const targetSection = document.getElementById(btn.target);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }
    });

    // 3. Animation pour la vidéo d'arrière-plan
    const video = document.getElementById('background-video');
    if (video) {
        const adjustVideoSize = function() {
            video.style.width = window.innerWidth + 'px';
            video.style.height = window.innerHeight + 'px';
        };
        window.addEventListener('resize', adjustVideoSize);
        adjustVideoSize(); // Appel initial
    }

    // 4. Effets de survol sur les cartes du menu
    const menuCards = document.querySelectorAll('.menu-card');
    menuCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // 5. Validation du formulaire de réservation
    const reservationForm = document.querySelector('.reservation-form');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(event) {
            const requiredFields = ['nom', 'email', 'date', 'heure', 'personnes', 'telephone'];
            let isValid = true;
            requiredFields.forEach(fieldId => {
                if (!document.getElementById(fieldId).value) {
                    isValid = false;
                }
            });
            if (!isValid) {
                alert('Veuillez remplir tous les champs requis.');
                event.preventDefault();
            }
        });
    }
});
>>>>>>> 71df9fe (Ajout du site web fini)
