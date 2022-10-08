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

            return $this->addOperation($number);
        }
        if(str_contains($numbers, ",")) {
            $number = preg_split("/[\n,]+/",$numbers);

            return $this->addOperation($number);
        }

        return $numbers;
    }

    /**
     * @param array $number
     * @return string
     */
    private function addOperation(array $number): string
    {
        $amountOfNumbers = count($number);
        $addResult = 0;
        for ($iterator = 0; $iterator < $amountOfNumbers; $iterator++) {
            $addResult = $addResult + $number[$iterator];
        }
        return $addResult;
    }
}