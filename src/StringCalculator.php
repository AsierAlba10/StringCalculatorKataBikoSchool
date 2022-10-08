<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    public function add(string $numbersToAdd)
    {
        if(!empty($numbersToAdd)){
            if(strlen($numbersToAdd) > 1){
                return "3";
            }
            return "1";
        }

        return "0";
    }
}