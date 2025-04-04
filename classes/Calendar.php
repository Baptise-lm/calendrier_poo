<?php
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
    $first_day_of_month = date('N', strtotime($this->start_date));
    $total_days_in_month = date('t', strtotime($this->start_date));

    echo '<div class="calendar">';
    echo '<div class="week">';
    echo '<div class="day-header">Lundi</div>';
    echo '<div class="day-header">Mardi</div>';
    echo '<div class="day-header">Mercredi</div>';
    echo '<div class="day-header">Jeudi</div>';
    echo '<div class="day-header">Vendredi</div>';
    echo '<div class="day-header">Samedi</div>';
    echo '<div class="day-header">Dimanche</div>';
    echo '</div>';

    echo '<div class="week">';
    for ($i = 1; $i < $first_day_of_month; $i++) {
      echo '<div class="day empty"></div>';
    }

    for ($day = 1; $day <= $total_days_in_month; $day++) {
      $current_date = date('Y-m-d', strtotime($this->start_date . " +" . ($day - 1) . " days"));
      echo '<div class="day" data-date="' . $current_date . '">';
      echo '<div class="day-number">' . $day . '</div>';
      foreach ($this->events as $event) {
        if ($event['date'] == $current_date) {
          echo '<div class="event" data-event-id="' . $event['id'] . '">';
          echo '<h3>' . $event['title'] . '</h3>';
          echo '<p>' . $event['description'] . '</p>';
          echo '<p>' . $event['start_time'] . ' - ' . $event['end_time'] . '</p>';
          echo '<a href="?controller=event&action=edit&id=' . $event['id'] . '">Modifier</a> | ';
          echo '<a href="?controller=event&action=delete&id=' . $event['id'] . '">Supprimer</a>';
          echo '</div>';
        }
      }
      echo '</div>';

      if (($day + $first_day_of_month - 1) % 7 == 0) {
        echo '</div><div class="week">';
      }
    }

    $last_day_of_month = date('N', strtotime($this->start_date . " +" . ($total_days_in_month - 1) . " days"));
    for ($i = $last_day_of_month; $i < 7; $i++) {
      echo '<div class="day empty"></div>';
    }

    echo '</div>';
    echo '</div>';
  }
}
