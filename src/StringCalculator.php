<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    public function add(string $numbers)
    {
        if(empty($numbers)){
            return "0";
        }
        if(str_starts_with($numbers, "//")){
            $newDelimiter = substr($numbers,2,1);
            $newAddString = substr($numbers, 4);
            $number = preg_split("/[\n,". $newDelimiter ."]+/",$newAddString);
            $amountOfNumbers = count($number);
            $addResult = 0;
            for($iterator = 0 ; $iterator < $amountOfNumbers ; $iterator++){
                $addResult = $addResult + $number[$iterator];
            }
            return $addResult;
        }
        if(str_contains($numbers, ",")) {
            $number = preg_split("/[\n,]+/",$numbers);
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