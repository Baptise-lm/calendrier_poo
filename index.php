<?php
// index.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';
require_once 'classes/Calendar.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);
$stmt = $event->read();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$calendar = new Calendar($events);
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
  <a href="add_event.php">Ajouter un événement</a>
  <?php $calendar->display(); ?>
  <?php include 'includes/footer.php'; ?>
</body>

</html>