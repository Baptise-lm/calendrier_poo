<?php
// classes/Calendar.php

class Calendar
{
  private $events;
  private $start_date;

  public function __construct($events, $start_date)
  {
    $this->events = $events;
    $this->start_date = $start_date;
  }

  public function display()
  {
    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    echo '<div class="calendar">';
    foreach ($days as $index => $day) {
      $current_date = date('Y-m-d', strtotime($this->start_date . " +$index days"));
      echo '<div class="day">';
      echo '<h2>' . $day . ' (' . date('d/m', strtotime($current_date)) . ')</h2>';
      foreach ($this->events as $event) {
        if ($event['date'] == $current_date) {
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
