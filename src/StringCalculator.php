<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    /**
     * @throws NegativeNotAllowedException
     */
    public function add(string $numbers): string
    {
        if(empty($numbers)){
            return "0";
        }
        if(str_contains($numbers, "-")){
            $number = preg_split("/[\n,]+/",$numbers);
            $amountOfNumbers = count($number);
            if($amountOfNumbers == 1){
                throw new NegativeNotAllowedException($numbers);
            }

            $negativeNumbers = "";
            for ($iterator = 0; $iterator < $amountOfNumbers; $iterator++) {
                if(str_contains($number[$iterator], "-")){
                    $negativeNumbers = $negativeNumbers . $number[$iterator] . ",";
                }
            }
            throw new NegativeNotAllowedException($negativeNumbers);
        }
        if(str_starts_with($numbers, "//")){
            if(str_contains($numbers, "[")){
                $firstPosDelimiter = strpos($numbers, "[") + 1;
                $lastPosDelimiter = strpos($numbers, "]");
                $breakLinePosition = strpos($numbers, "\n");

                $delimiterLength = ($lastPosDelimiter - $firstPosDelimiter);

                $newDelimiter = substr($numbers,3,$delimiterLength);

                $newAddString = substr($numbers, $breakLinePosition+1);
                $number = preg_split("/[\n,". $newDelimiter ."]+/",$newAddString);

                echo $newDelimiter . " " . $newAddString;

                return $this->addOperation($number);
            }

            $newDelimiter = substr($numbers,2,1);
            $newAddString = substr($numbers, 4);
            $number = preg_split("/[\n,". $newDelimiter ."]+/",$newAddString);

            return $this->addOperation($number);
        }
        if(str_contains($numbers, ",")) {
            $number = preg_split("/[\n,]+/",$numbers);

            if(!$this->isUnderLimit($number))
            {
                return  $this->getStringUnderLimit($number);
            }

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
        $addResult = "0";
        for ($iterator = 0; $iterator < $amountOfNumbers; $iterator++) {
            $addResult = $addResult + $number[$iterator];
        }
        return $addResult;
    }

    /**
     * @param array $number
     * @return string
     */
    public function getStringUnderLimit(array $number): string
    {
        $amountOfNumbers = count($number);
        $numberUnderLimit = "";
        for ($iterator = 0; $iterator < $amountOfNumbers; $iterator++) {
            if ($number[$iterator] < 1000) {
                $numberUnderLimit = $numberUnderLimit . $number[$iterator];
            }
        }
        return $numberUnderLimit;
    }

    private function isUnderLimit(array $number): bool
    {
        $amountOfNumbers = count($number);
        for ($iterator = 0; $iterator < $amountOfNumbers; $iterator++) {
            if ($number[$iterator] > 1000) {
                return false;
            }
        }
        return true;
    }
}