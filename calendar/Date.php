<?php


class Date extends DateTime {

    public function getMonth(){
        return (int) $this->format("n");
    }

    public function getYear() {
        return (int) $this->format("Y");
    }
    public function getTime() {
        return $this->format("H:i:s");
    }

    public function getDate() {
        return $this->format("l d F Y");
    }

    public function getSubDate() {
        return $this->format("F Y");
    }

    public function getFirstDayOfMonthPosition() {
        return (int) $this->modify("first day of this month")->format('w');
    }

    public function getLastDayOfLastMonth() {
        return (int) $this->modify('last day of last month')->format('d');
    }

    public function getNumberOfDaysOfMonth() {
        return (int) $this->format('t');
    }
}