<?php
// add_event.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

if ($_POST) {
  $event->title = $_POST['title'];
  $event->description = $_POST['description'];
  $event->start_time = $_POST['start_time'];
  $event->end_time = $_POST['end_time'];
  $event->day = $_POST['day'];

  if ($event->create()) {
    header("Location: index.php");
  } else {
    echo "Erreur lors de la création de l'événement.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter un événement</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <h1>Ajouter un événement</h1>
  <form method="post">
    <label for="title">Titre:</label>
    <input type="text" name="title" required>
    <label for="description">Description:</label>
    <textarea name="description"></textarea>
    <label for="start_time">Heure de début:</label>
    <input type="time" name="start_time" required>
    <label for="end_time">Heure de fin:</label>
    <input type="time" name="end_time" required>
    <label for="day">Jour:</label>
    <select name="day" required>
      <option value="Lundi">Lundi</option>
      <option value="Mardi">Mardi</option>
      <option value="Mercredi">Mercredi</option>
      <option value="Jeudi">Jeudi</option>
      <option value="Vendredi">Vendredi</option>
      <option value="Samedi">Samedi</option>
      <option value="Dimanche">Dimanche</option>
    </select>
    <button type="submit">Ajouter</button>
  </form>
  <?php include 'includes/footer.php'; ?>
</body>

</html>