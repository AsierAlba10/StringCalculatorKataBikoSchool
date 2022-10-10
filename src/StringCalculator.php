<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    /**
     * @throws NegativeNotAllowedException
     */
    public function add(string $numbers): string
    {
        if($this->isEmptyCase($numbers)){
            return $this->operateWithIsEmptyCase();
        }
        if($this->isNegativeNumbersCase($numbers)){
            $this->operateWithNegativeNumbersCase($numbers);
        }
        if($this->isDelimiterExpressionsCase($numbers)){
            if($this->isOneCharacterNewDelimiterCase($numbers))
            {
                return $this->operateWithIsOneCharacterNewDelimiterCase($numbers);
            }
            if($this->isNewDelimiterLargerThanOneCharacterCase($numbers))
            {
                if($this->isMoreThanOneNewDelimiterCase($numbers))
                {
                    return $this->operateWithIsMoreThanOneNewDelimiterCase($numbers);
                }

                return $this->operateWithIsNewDelimiterLargerThanOneCharacterCase($numbers);
            }
        }
        if($this->isNumbersToAddCase($numbers)) {
            return $this->operateWithNumbersToAddCase($numbers);
        }

        return $numbers;
    }

    /**
     * @param string $numbers
     * @return bool
     */
    private function isEmptyCase(string $numbers): bool
    {
        return empty($numbers);
    }

    /**
     * @return string
     */
    private function operateWithIsEmptyCase(): string
    {
        return "0";
    }

    /**
     * @param string $numbers
     * @return bool
     */
    private function isNegativeNumbersCase(string $numbers): bool
    {
        return str_contains($numbers, "-");
    }

    /**
     * @param string $numbers
     * @throws NegativeNotAllowedException
     */
    private function operateWithNegativeNumbersCase(string $numbers)
    {
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

    /**
     * @param string $numbers
     * @return bool
     */
    private function isDelimiterExpressionsCase(string $numbers): bool
    {
        return str_starts_with($numbers, "//");
    }

    /**
     * @param string $numbers
     * @return bool
     */
    private function isOneCharacterNewDelimiterCase(string $numbers): bool
    {
        return !str_contains($numbers, "[");
    }

    /**
     * @param string $numbers
     * @return string
     */
    private function operateWithIsOneCharacterNewDelimiterCase(string $numbers): string
    {
        $newDelimiter = substr($numbers,2,1);
        $newAddString = substr($numbers, 4);

        $number = preg_split("/[\n,". $newDelimiter ."]+/",$newAddString);

        return $this->addOperation($number);
    }

    /**
     * @param string $numbers
     * @return bool
     */
    private function isNewDelimiterLargerThanOneCharacterCase(string $numbers): bool
    {
        return str_contains($numbers, "[");
    }

    /**
     * @param string $numbers
     * @return string
     */
    private function operateWithIsNewDelimiterLargerThanOneCharacterCase(string $numbers): string
    {
        return $this->getNewDelimiter($numbers);
    }

    /**
     * @param string $numbers
     * @return bool
     */
    private function isMoreThanOneNewDelimiterCase(string $numbers): bool
    {
        $amountOfDelimiters = substr_count($numbers,"[");
        return $amountOfDelimiters > 1;
    }

    /**
     * @param string $numbers
     * @return string
     */
    private function operateWithIsMoreThanOneNewDelimiterCase(string $numbers): string
    {
        $convertedNumbers = str_replace("][",",",$numbers);
        return $this->getNewDelimiter($convertedNumbers);
    }


    /**
     * @param string $numbers
     * @return bool
     */
    private function isNumbersToAddCase(string $numbers): bool
    {
        return str_contains($numbers, ",");
    }

    /**
     * @param string $numbers
     * @return string
     */
    private function operateWithNumbersToAddCase(string $numbers): string
    {
        $number = preg_split("/[\n,]+/",$numbers);

        if(!$this->isUnderLimit($number))
        {
            return  $this->getStringUnderLimit($number);
        }

        return $this->addOperation($number);
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
     * @return bool
     */
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

    /**
     * @param string $convertedNumbers
     * @return string
     */
    private function getNewDelimiter(string $convertedNumbers): string
    {
        $firstPosDelimiterBracket = strpos($convertedNumbers, "[") + 1;
        $lastPosDelimiterBracket = strpos($convertedNumbers, "]");
        $breakLinePosition = strpos($convertedNumbers, "\n");

        $delimiterLength = ($lastPosDelimiterBracket - $firstPosDelimiterBracket);

        $newDelimiter = substr($convertedNumbers, 3, $delimiterLength);

        $newAddString = substr($convertedNumbers, $breakLinePosition + 1);

        $number = preg_split("/[\n," . $newDelimiter . "]+/", $newAddString);

        return $this->addOperation($number);
    }


}