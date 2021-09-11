<?php
namespace web;
Class AirportValidator {
    public function isMinutesException(int $minute): void{
        if($minute < 0 || $minute > 60){
            throw new \InvalidArgumentException($minute .' is negative of greater then 60');
        }
    }
    public function isYearException(int $year): void{
        if($year < 1900){
            throw new \InvalidArgumentException($year .' is negative of greater then 60');
        }
    }
    public function isValidStringException(string $input): void{
        if(strlen($input) > 6 || strlen($input) < 6){
            //
            throw new \InvalidArgumentException($input .' is more then 6 digits');
        }
    }
}