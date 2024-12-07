<?php

require_once __DIR__ ."/../Calendar.php";

class CalendarController {


    public function getTime() {
        $calendar = new Calendar();
        return $calendar->getTime();
    }

    public function getDate() {
        $calendar = new Calendar();
        return $calendar->getDate();
    }

    public function getSubDate() {

        $month = (int) $_POST['month'];
        $year = (int) $_POST['year'];
        
        $calendar = new Calendar();

        if($month != null && $year != null) {
            $calendar->setDate($year, $month, 1);
        }
        
        return json_encode($calendar->getSubDate());
    }

    public function getLastWeekOfPreviousMonth() {
        
        $month = (int) $_POST['month'];
        $year = (int) $_POST['year'];
        
        $calendar = new Calendar();

        if($month != null && $year != null) {
            $calendar->setDate($year, $month, 1);
        }

        $days = $calendar->getLastWeekOfPreviousMonth();
    
        return json_encode($days);
    }


    public function getDaysOfMonth() {

        $month = (int) $_POST['month'];
        $year = (int) $_POST['year'];
        
        $calendar = new Calendar();

        if($month != null && $year != null) {
            $calendar->setDate($year, $month, 1);
        }

        $days = $calendar->getDaysOfMonth();

        return json_encode($days);
    }


    public function getMonth() {
        $calendar = new Calendar();

        return $calendar->getCurrentMonth();
    }

    public function getYear() {
        $calendar = new Calendar();
        return $calendar->getCurrentYear();
    }
}