<?php
namespace web;

trait AirportTrait
{
    function getUniqueFirstLetters(array $airports)
    {
        $letters = [];
        foreach ($airports as $airport){
            $letters[] = substr($airport['name'], 0, 1);
        }
        asort($letters);

        return array_unique($letters);
    }
}

Class AirportValidator 
{
    use AirportTrait;
}