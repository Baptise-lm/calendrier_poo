<?php
// delete_event.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

$event->id = $_GET['id'];

if ($event->delete()) {
  header("Location: index.php");
} else {
  echo "Erreur lors de la suppression de l'événement.";
}
