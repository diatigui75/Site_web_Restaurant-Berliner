
            /**
         * Fonction appelée quand on clique sur "Modifier"
         * Elle transforme la ligne du tableau en champs de formulaire
         */
        function editReservation(id) {
            const row = document.getElementById('reservation-' + id);
            const cells = row.getElementsByTagName('td');
             // On remplace le texte par des champs input/textarea préremplis
            cells[1].innerHTML = `<input type="text" value="${cells[1].textContent}" />`;
            cells[2].innerHTML = `<input type="email" value="${cells[2].textContent}" />`;
            cells[3].innerHTML = `<input type="date" value="${cells[3].textContent}" />`;
            cells[4].innerHTML = `<input type="time" value="${cells[4].textContent}" />`;
            cells[5].innerHTML = `<input type="number" value="${cells[5].textContent}" />`;
            cells[6].innerHTML = `<input type="text" value="${cells[6].textContent}" />`;
            cells[7].innerHTML = `<textarea>${cells[7].textContent}</textarea>`;
             // Remplace le bouton par "Enregistrer"
            cells[8].innerHTML = `<button class="edit-button" onclick="saveReservation(${id})">Enregistrer</button>`;
        }
          /**
         * Fonction qui envoie les nouvelles données au serveur via fetch (AJAX)
         */
        function saveReservation(id) {
            const row = document.getElementById('reservation-' + id);
            const cells = row.getElementsByTagName('td');
            // Préparation des données à envoyer
            const formData = new FormData();
            formData.append('update_reservation', '1');
            formData.append('id', id);
            formData.append('full_name', cells[1].getElementsByTagName('input')[0].value);
            formData.append('email', cells[2].getElementsByTagName('input')[0].value);
            formData.append('date', cells[3].getElementsByTagName('input')[0].value);
            formData.append('time', cells[4].getElementsByTagName('input')[0].value);
            formData.append('guests', cells[5].getElementsByTagName('input')[0].value);
            formData.append('phone', cells[6].getElementsByTagName('input')[0].value);
            formData.append('special_requests', cells[7].getElementsByTagName('textarea')[0].value);

         fetch(`reservation.php?action=delete&id=${id}`)
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })

            .catch(error => console.error('Error:', error));
        }
          /**
         * Fonction pour supprimer une réservation
         * Demande confirmation puis envoie une requête GET à reservation.php
         */
        function deleteReservation(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')) {
                fetch(`reservation.php?action=delete&id=${id}`)
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }