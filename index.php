<?php
// index.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';
require_once 'classes/Calendar.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

// Récupérer le mois courant
$current_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$start_date = date('Y-m-01', strtotime($current_month)); // Premier jour du mois
$end_date = date('Y-m-t', strtotime($current_month)); // Dernier jour du mois

// Récupérer les événements du mois
$stmt = $event->readByMonth($start_date, $end_date);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$calendar = new Calendar($events, $start_date);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Planning Mensuel</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <h1>Planning Mensuel</h1>

    <!-- Navigation entre les mois -->
    <div class="month-navigation">
        <a href="index.php?month=<?php echo date('Y-m', strtotime('-1 month', strtotime($current_month))); ?>">Mois précédent</a>
        <span><?php echo date('F Y', strtotime($current_month)); ?></span>
        <a href="index.php?month=<?php echo date('Y-m', strtotime('+1 month', strtotime($current_month))); ?>">Mois suivant</a>
    </div>

    <a href="add_event.php">Ajouter un événement</a>
    <?php $calendar->display(); ?>
    <?php include 'includes/footer.php'; ?>

    <script>
        // Fonction pour gérer le drag and drop
        $(document).ready(function() {
            // Rendre les événements draggables
            $('.event').attr('draggable', true);

            // Événement de début de drag
            $('.event').on('dragstart', function(e) {
                e.originalEvent.dataTransfer.setData('text/plain', $(this).data('event-id'));
            });

            // Événement de drop
            $('.day').on('dragover', function(e) {
                e.preventDefault(); // Permettre le drop
            });

            $('.day').on('drop', function(e) {
                e.preventDefault();
                const eventId = e.originalEvent.dataTransfer.getData('text/plain');
                const newDate = $(this).data('date'); // Récupérer la nouvelle date

                // Envoyer une requête AJAX pour mettre à jour la date de l'événement
                $.ajax({
                    url: 'update_event_date.php',
                    method: 'POST',
                    data: {
                        event_id: eventId,
                        new_date: newDate
                    },
                    success: function(response) {
                        if (response === 'success') {
                            location.reload(); // Recharger la page pour afficher les changements
                        } else {
                            alert('Erreur lors de la mise à jour de l\'événement.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>