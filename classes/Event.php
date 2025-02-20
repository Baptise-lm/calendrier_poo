<?php
// classes/Event.php

class Event
{
  private $conn;
  private $table = 'events';

  public $id;
  public $title;
  public $description;
  public $start_time;
  public $end_time;
  public $day;
  public $date;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function create()
  {
    $query = "INSERT INTO " . $this->table . " SET title=:title, description=:description, start_time=:start_time, end_time=:end_time, day=:day, date=:date";
    $stmt = $this->conn->prepare($query);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->start_time = htmlspecialchars(strip_tags($this->start_time));
    $this->end_time = htmlspecialchars(strip_tags($this->end_time));
    $this->day = htmlspecialchars(strip_tags($this->day));
    $this->date = htmlspecialchars(strip_tags($this->date));

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':start_time', $this->start_time);
    $stmt->bindParam(':end_time', $this->end_time);
    $stmt->bindParam(':day', $this->day);
    $stmt->bindParam(':date', $this->date);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function readByWeek($start_date, $end_date)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE date BETWEEN :start_date AND :end_date ORDER BY date, start_time";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    return $stmt;
  }

  public function update()
  {
    $query = "UPDATE " . $this->table . " SET title=:title, description=:description, start_time=:start_time, end_time=:end_time, day=:day, date=:date WHERE id=:id";
    $stmt = $this->conn->prepare($query);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->start_time = htmlspecialchars(strip_tags($this->start_time));
    $this->end_time = htmlspecialchars(strip_tags($this->end_time));
    $this->day = htmlspecialchars(strip_tags($this->day));
    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':start_time', $this->start_time);
    $stmt->bindParam(':end_time', $this->end_time);
    $stmt->bindParam(':day', $this->day);
    $stmt->bindParam(':date', $this->date);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function delete()
  {
    $query = "DELETE FROM " . $this->table . " WHERE id=:id";
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function readOne()
  {
    $query = "SELECT title, description, start_time, end_time, day FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    return $stmt;
  }

  public function readByMonth($start_date, $end_date)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE date BETWEEN :start_date AND :end_date ORDER BY date, start_time";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    return $stmt;
  }

  public function updateDate()
  {
    $query = "UPDATE " . $this->table . " SET date=:date WHERE id=:id";
    $stmt = $this->conn->prepare($query);

    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':date', $this->date);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
