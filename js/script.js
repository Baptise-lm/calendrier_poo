document.addEventListener('DOMContentLoaded', function() {
    // Initialiser SortableJS sur les éléments avec la classe 'day'
    var days = document.querySelectorAll('.day');
    days.forEach(function(day) {
        Sortable.create(day, {
            group: 'shared',
            animation: 150,
            onEnd: function(evt) {
                var eventId = evt.item.getAttribute('data-event-id');
                var newDate = evt.to.getAttribute('data-date');

                // Envoyer une requête AJAX pour mettre à jour la date de l'événement
                fetch('?controller=event&action=updateDate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'event_id=' + encodeURIComponent(eventId) + '&new_date=' + encodeURIComponent(newDate)
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour de l\'événement.');
                    }
                });
            }
        });
    });

    // Initialiser SortableJS sur les événements prédéfinis
    var predefinedEventsList = document.getElementById('predefined-events-list');
    Sortable.create(predefinedEventsList, {
        group: 'shared',
        animation: 150,
        sort: true, // Permettre le tri des événements prédéfinis
        onEnd: function(evt) {
            if (evt.to.id === 'predefined-events-list') {
                // Si l'événement est déplacé dans la liste des événements prédéfinis, ne rien faire
                return;
            }

            var eventId = evt.item.getAttribute('data-event-id');
            var newDate = evt.to.getAttribute('data-date');

            // Envoyer une requête AJAX pour ajouter l'événement prédéfini au calendrier
            fetch('?controller=event&action=addPredefinedEvent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'event_id=' + encodeURIComponent(eventId) + '&new_date=' + encodeURIComponent(newDate)
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    location.reload();
                } else {
                    alert('Erreur lors de l\'ajout de l\'événement.');
                }
            });
        }
    });
});
