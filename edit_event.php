<?php
// edit_event.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

$event->id = $_GET['id'];

if ($_POST) {
  $event->title = $_POST['title'];
  $event->description = $_POST['description'];
  $event->start_time = $_POST['start_time'];
  $event->end_time = $_POST['end_time'];
  $event->day = $_POST['day'];

  if ($event->update()) {
    header("Location: index.php");
  } else {
    echo "Erreur lors de la mise à jour de l'événement.";
  }
} else {
  $stmt = $event->readOne();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $event->title = $row['title'];
  $event->description = $row['description'];
  $event->start_time = $row['start_time'];
  $event->end_time = $row['end_time'];
  $event->day = $row['day'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un événement</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <h1>Modifier un événement</h1>
  <form method="post">
    <label for="title">Titre:</label>
    <input type="text" name="title" value="<?php echo $event->title; ?>" required>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo $event->description; ?></textarea>
    <label for="start_time">Heure de début:</label>
    <input type="time" name="start_time" value="<?php echo $event->start_time; ?>" required>
    <label for="end_time">Heure de fin:</label>
    <input type="time" name="end_time" value="<?php echo $event->end_time; ?>" required>
    <label for="day">Jour:</label>
    <select name="day" required>
      <option value="Lundi" <?php echo ($event->day == 'Lundi') ? 'selected' : ''; ?>>Lundi</option>
      <option value="Mardi" <?php echo ($event->day == 'Mardi') ? 'selected' : ''; ?>>Mardi</option>
      <option value="Mercredi" <?php echo ($event->day == 'Mercredi') ? 'selected' : ''; ?>>Mercredi</option>
      <option value="Jeudi" <?php echo ($event->day == 'Jeudi') ? 'selected' : ''; ?>>Jeudi</option>
      <option value="Vendredi" <?php echo ($event->day == 'Vendredi') ? 'selected' : ''; ?>>Vendredi</option>
      <option value="Samedi" <?php echo ($event->day == 'Samedi') ? 'selected' : ''; ?>>Samedi</option>
      <option value="Dimanche" <?php echo ($event->day == 'Dimanche') ? 'selected' : ''; ?>>Dimanche</option>
    </select>
    <button type="submit">Modifier</button>
  </form>
  <?php include 'includes/footer.php'; ?>
</body>

</html>