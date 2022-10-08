<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    public function add(string $numbers)
    {
        if(empty($numbers)){
            return "0";
        }
        if(str_contains($numbers, ",")) {
            $number = explode(",", $numbers);
            $amountOfNumbers = count($number);
            $addResult = 0;
            for($iterator = 0 ; $iterator < $amountOfNumbers ; $iterator++){
                $addResult = $addResult + $number[$iterator];
            }
            return $addResult;
        }

        return $numbers;
    }
}