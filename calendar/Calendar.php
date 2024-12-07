<?php 

require_once "Date.php";

class Calendar extends Date {


    public function getLastWeekOfPreviousMonth() {
        
        $days = [];
        
        $firstDayOfMonthPosition = $this->getFirstDayOfMonthPosition();
        $lastWeekOfLastMonth = $firstDayOfMonthPosition == 0 ? 6 : $firstDayOfMonthPosition - 1;
        
        $lastDayOfLastMonth = $this->getLastDayOfLastMonth();

        for ($i = 1; $i <= $lastWeekOfLastMonth; $i++) {
            array_unshift($days, $lastDayOfLastMonth);
            $lastDayOfLastMonth--;
        }

        return $days;
    }


    public function getDaysOfMonth() {
        $days = [];
        $daysOfMonthNumber = $this->getNumberOfDaysOfMonth();
    
        for ($i = 1; $i <= $daysOfMonthNumber; $i++) {
            $days[] = $i;
        }

        return $days;
    }


    public function getCurrentMonth(){
        return $this->getMonth();
    }

    public function getCurrentYear(){
        return $this->getYear();
    }
}