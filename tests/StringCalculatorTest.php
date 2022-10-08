<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;
    /**
     * @test
     **/
    public function givenAnEmptyStringReturns()
    {
        $this->stringCalculator = new StringCalculator();

        $response = $this->stringCalculator->add("");

        $this->assertEquals($response, "0");
    }

    /**
     * @test
     **/
    public function givenOneNumberReturnsTheNumber()
    {
        $this->stringCalculator = new StringCalculator();

        $response = $this->stringCalculator->add("1");

        $this->assertEquals($response, "1");
    }

    /**
     * @test
     **/
    public function givenTwoNumbersReturnsTheResultOfTheAddOperation()
    {
        $this->stringCalculator = new StringCalculator();

        $response = $this->stringCalculator->add("1,2");

        $this->assertEquals($response, "3");
    }

}