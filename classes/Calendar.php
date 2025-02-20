<?php
// classes/Calendar.php

class Calendar
{
  private $events;

  public function __construct($events)
  {
    $this->events = $events;
  }

  public function display()
  {
    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    echo '<div class="calendar">';
    foreach ($days as $day) {
      echo '<div class="day">';
      echo '<h2>' . $day . '</h2>';
      foreach ($this->events as $event) {
        if ($event['day'] == $day) {
          echo '<div class="event">';
          echo '<h3>' . $event['title'] . '</h3>';
          echo '<p>' . $event['description'] . '</p>';
          echo '<p>' . $event['start_time'] . ' - ' . $event['end_time'] . '</p>';
          echo '<a href="edit_event.php?id=' . $event['id'] . '">Modifier</a> | ';
          echo '<a href="delete_event.php?id=' . $event['id'] . '">Supprimer</a>';
          echo '</div>';
        }
      }
      echo '</div>';
    }
    echo '</div>';
  }
}
