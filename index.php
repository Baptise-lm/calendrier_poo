<?php
// index.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';
require_once 'classes/Calendar.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

// Récupérer la semaine courante
$current_week = isset($_GET['week']) ? $_GET['week'] : date('Y-m-d');
$start_date = date('Y-m-d', strtotime('monday this week', strtotime($current_week)));
$end_date = date('Y-m-d', strtotime('sunday this week', strtotime($current_week)));

// Récupérer les événements de la semaine
$stmt = $event->readByWeek($start_date, $end_date);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$calendar = new Calendar($events, $start_date);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Planning Hebdomadaire</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <h1>Planning Hebdomadaire</h1>

  <!-- Navigation entre les semaines -->
  <div class="week-navigation">
    <a href="index.php?week=<?php echo date('Y-m-d', strtotime('-1 week', strtotime($current_week))); ?>">Semaine précédente</a>
    <span>Semaine du <?php echo date('d/m/Y', strtotime($start_date)); ?> au <?php echo date('d/m/Y', strtotime($end_date)); ?></span>
    <a href="index.php?week=<?php echo date('Y-m-d', strtotime('+1 week', strtotime($current_week))); ?>">Semaine suivante</a>
  </div>

  <a href="add_event.php">Ajouter un événement</a>
  <?php $calendar->display(); ?>
  <?php include 'includes/footer.php'; ?>
</body>

</html>