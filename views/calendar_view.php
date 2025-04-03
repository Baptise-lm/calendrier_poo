<h1>Planning Mensuel</h1>
<div class="month-navigation">
  <a href="?controller=calendar&action=show&month=<?php echo $prevMonth; ?>">Mois précédent</a>
  <span><?php echo $currentMonth; ?></span>
  <a href="?controller=calendar&action=show&month=<?php echo $nextMonth; ?>">Mois suivant</a>
</div>
<a href="?controller=event&action=add">Ajouter un événement</a>

<div class="calendar-container">
  <?php $calendar->display(); ?>

  <div class="predefined-events">
    <h2>Événements Prédéfinis</h2>
    <div id="predefined-events-list">
      <?php foreach ($predefinedEvents as $predefinedEvent): ?>
        <div class="predefined-event" data-event-id="<?php echo $predefinedEvent['id']; ?>">
          <h3><?php echo $predefinedEvent['event']; ?></h3>
          <p><?php echo $predefinedEvent['description']; ?></p>
          <button onclick="addPredefinedEventToCalendar(<?php echo $predefinedEvent['id']; ?>)">Ajouter au calendrier</button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
  function addPredefinedEventToCalendar(eventId) {
    // Demander à l'utilisateur de sélectionner une date pour l'événement prédéfini
    var newDate = prompt("Veuillez entrer la date pour cet événement (format YYYY-MM-DD):");
    if (newDate) {
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
  }
</script>