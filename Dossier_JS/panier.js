document.addEventListener('DOMContentLoaded', function() {
        // Tableau des prix
        const prices = {
            'Kebab Veau': 9,
            'Kebab Poulet': 9,
            'Kebab Végétarien': 9,
            'Kebab Gourmand': 9,
            'Frites': 2.00,
            'Coca cola': 1.5,
            'Dada mangue': 1.5,
            'Eau plate': 1.5,
            'Eau petillante': 1.5,
            'Ice tea': 1.5,
            'Coca 0': 1.5,
            'Scheweppes agrum': 1.5,
            'Orangina': 1.5,
            'Bierre': 3,
            'Oasis': 1.5,
            'Chedar au poivre': 1.5,
            'Piment jalapenos': 1.5,
            'Supplement viande': 3.0
        };

        // Sélection des kebabs
        const kebabOptions = document.querySelectorAll('.kebab-option');
        kebabOptions.forEach(option => {
            option.addEventListener('click', function() {
                kebabOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selectedKebab').value = this.dataset.value;
                updateTotalDisplay();
            });
        });

        // Sélection des sauces pour le kebab
        const sauceKebabOptions = document.querySelectorAll('.sauce-kebab-options .sauce-option');
        sauceKebabOptions.forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateTotalDisplay();
            });
        });

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

        // Sélection des boissons
        const drinkOptions = document.querySelectorAll('.drink-option');
        drinkOptions.forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateTotalDisplay();
            });
        });

        // Sélection des extras
        const extraOptions = document.querySelectorAll('.extra-option');
        extraOptions.forEach(option => {
            option.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateTotalDisplay();
            });
        });

        // Fonction pour calculer le total
        function calculateTotalForm() {
            let total = 0;
            // Prix du kebab
            const kebab = document.getElementById('selectedKebab').value;
            if (kebab && prices[kebab] !== undefined) {
                total += prices[kebab];
            }
            // Prix des frites sélectionnées
            const selectedFrites = document.querySelectorAll('.frites-option.selected');
            selectedFrites.forEach(frite => {
                const friteValue = frite.dataset.value;
                if (prices[friteValue] !== undefined) {
                    total += prices[friteValue];
                }
            });
            // Prix des boissons sélectionnées
            const selectedDrinks = document.querySelectorAll('.drink-option.selected');
            selectedDrinks.forEach(drink => {
                const drinkValue = drink.dataset.value;
                if (prices[drinkValue] !== undefined) {
                    total += prices[drinkValue];
                }
            });
            // Prix des extras sélectionnés
            const selectedExtras = document.querySelectorAll('.extra-option.selected');
            selectedExtras.forEach(extra => {
                const extraValue = extra.dataset.value;
                if (prices[extraValue] !== undefined) {
                    total += prices[extraValue];
                }
            });
            // Prix des sauces supplémentaires pour le kebab
            const saucesKebab = document.querySelectorAll('.sauce-kebab-options .sauce-option.selected');
            if (saucesKebab.length > 1) {
                total += 0.20 * (saucesKebab.length - 1);
            }
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

        // Gestion de la soumission du formulaire
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            // Vérifier si un kebab est sélectionné
            const selectedKebab = document.getElementById('selectedKebab').value;
            if (!selectedKebab) {
                alert("Veuillez choisir un kebab.");
                e.preventDefault();
                return;
            }

            // Vérifier si au moins une sauce pour le kebab est sélectionnée
            const selectedSaucesKebab = document.querySelectorAll('.sauce-kebab-options .sauce-option.selected');
            if (selectedSaucesKebab.length === 0) {
                alert("Veuillez choisir au moins une sauce pour le kebab.");
                e.preventDefault();
                return;
            }

            // Vérifier si au moins une portion de frites est sélectionnée
            const selectedFrites = document.querySelectorAll('.frites-option.selected');
            if (selectedFrites.length === 0) {
                alert("Veuillez choisir au moins une portion de frites.");
                e.preventDefault();
                return;
            }

            // Vérifier si au moins une boisson est sélectionnée
            const selectedDrinks = document.querySelectorAll('.drink-option.selected');
            if (selectedDrinks.length === 0) {
                alert("Veuillez choisir au moins une boisson.");
                e.preventDefault();
                return;
            }

            // Collecte des sauces pour le kebab
            const selectedSaucesKebabValues = [];
            selectedSaucesKebab.forEach(option => {
                selectedSaucesKebabValues.push(option.dataset.value);
            });
            document.getElementById('selectedSaucesKebab').value = selectedSaucesKebabValues.join(',');

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

            // Collecte des boissons sélectionnées
            const selectedDrinksValues = [];
            selectedDrinks.forEach(option => {
                selectedDrinksValues.push(option.dataset.value);
            });
            document.getElementById('selectedDrinks').value = selectedDrinksValues.join(',');

            // Collecte des extras sélectionnés
            const selectedExtras = [];
            document.querySelectorAll('.extra-option.selected').forEach(option => {
                selectedExtras.push(option.dataset.value);
            });
            document.getElementById('selectedExtras').value = selectedExtras.join(',');
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
