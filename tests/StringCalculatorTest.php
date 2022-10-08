<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    /**
     * @setUp
     **/
    protected function setUp(): void
    {
        parent::setUp();

        $this->stringCalculator = new StringCalculator();
    }


    /**
     * @test
     **/
    public function givenAnEmptyStringReturns()
    {
        $response = $this->stringCalculator->add("");

        $this->assertEquals($response, "0");
    }

    /**
     * @test
     **/
    public function givenOneNumberReturnsTheNumber()
    {
        $response = $this->stringCalculator->add("1");

        $this->assertEquals($response, "1");
    }

    /**
     * @test
     **/
    public function givenTwoNumbersReturnsTheResultOfTheAddOperation()
    {
        $response = $this->stringCalculator->add("1,2");

        $this->assertEquals($response, "3");
    }


}