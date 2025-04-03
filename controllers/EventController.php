<?php
require_once 'classes/Database.php';
require_once 'classes/Event.php';

class EventController
{
  private $db;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function add()
  {
    $event = new Event($this->db);

    if ($_POST) {
      $event->title = $_POST['title'];
      $event->description = $_POST['description'];
      $event->start_time = $_POST['start_time'];
      $event->end_time = $_POST['end_time'];
      $event->day = $_POST['day'];
      $event->date = $_POST['date'];

      if ($event->create()) {
        header("Location: ?controller=calendar&action=show");
      } else {
        echo "Erreur lors de la création de l'événement.";
      }
    } else {
      $title = "Ajouter un événement";
      $action = "add";
      $buttonText = "Ajouter";
      include 'views/header.php';
      include 'views/event_form.php';
      include 'views/footer.php';
    }
  }

  public function edit()
  {
    $event = new Event($this->db);
    $event->id = $_GET['id'];

    if ($_POST) {
      $event->title = $_POST['title'];
      $event->description = $_POST['description'];
      $event->start_time = $_POST['start_time'];
      $event->end_time = $_POST['end_time'];
      $event->day = $_POST['day'];
      $event->date = $_POST['date'];

      if ($event->update()) {
        header("Location: ?controller=calendar&action=show");
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
      $event->date = $row['date'];

      $title = "Modifier un événement";
      $action = "edit";
      $buttonText = "Modifier";
      include 'views/header.php';
      include 'views/event_form.php';
      include 'views/footer.php';
    }
  }

  public function delete()
  {
    $event = new Event($this->db);
    $event->id = $_GET['id'];

    if ($event->delete()) {
      header("Location: ?controller=calendar&action=show");
    } else {
      echo "Erreur lors de la suppression de l'événement.";
    }
  }

  public function updateDate()
  {
    $event = new Event($this->db);

    if ($_POST) {
      $event->id = $_POST['event_id'];
      $event->date = $_POST['new_date'];

      if ($event->updateDate()) {
        echo 'success';
      } else {
        echo 'error';
      }
    }
  }

  public function addPredefinedEvent()
  {
    $event = new Event($this->db);

    if ($_POST) {
      $predefinedEventId = $_POST['event_id'];
      $newDate = $_POST['new_date'];

      // Récupérer les détails de l'événement prédéfini
      $stmt = $this->db->prepare("SELECT event, description FROM predefined_events WHERE id = ?");
      $stmt->execute([$predefinedEventId]);
      $predefinedEvent = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($predefinedEvent) {
        $event->title = $predefinedEvent['event'];
        $event->description = $predefinedEvent['description'];
        $event->start_time = '09:00'; // Heure de début par défaut
        $event->end_time = '10:00'; // Heure de fin par défaut
        $event->day = date('l', strtotime($newDate)); // Jour de la semaine
        $event->date = $newDate;

        if ($event->create()) {
          echo 'success';
        } else {
          echo 'error';
        }
      } else {
        echo 'error';
      }
    }
  }
}
