<h1><?php echo $title; ?></h1>
<form method="post" action="?controller=event&action=<?php echo $action; ?>">
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
  <label for="date">Date:</label>
  <input type="date" name="date" value="<?php echo $event->date; ?>" required>
  <button type="submit"><?php echo $buttonText; ?></button>
</form>