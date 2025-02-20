<?php
// update_event_date.php

require_once 'classes/Database.php';
require_once 'classes/Event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

if ($_POST) {
  $event->id = $_POST['event_id'];
  $event->date = $_POST['new_date'];

  if ($event->updateDate()) {
    echo 'success';
  } else {
    echo 'error';
  }
}
