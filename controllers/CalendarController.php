<?php
require_once 'classes/Database.php';
require_once 'classes/Event.php';
require_once 'classes/Calendar.php';

class CalendarController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function show()
    {
        $event = new Event($this->db);
        $current_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
        $start_date = date('Y-m-01', strtotime($current_month));
        $end_date = date('Y-m-t', strtotime($current_month));

        $stmt = $event->readByMonth($start_date, $end_date);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $predefinedStmt = $event->getPredefinedEvents();
        $predefinedEvents = $predefinedStmt->fetchAll(PDO::FETCH_ASSOC);

        $calendar = new Calendar($events, $start_date);

        $prevMonth = date('Y-m', strtotime('-1 month', strtotime($current_month)));
        $nextMonth = date('Y-m', strtotime('+1 month', strtotime($current_month)));
        $currentMonth = date('F Y', strtotime($current_month));

        include 'views/header.php';
        include 'views/calendar_view.php';
        include 'views/footer.php';
    }
}
