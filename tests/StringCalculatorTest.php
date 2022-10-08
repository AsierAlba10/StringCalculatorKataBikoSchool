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
        $response = $this->stringCalculator->add("144");

        $this->assertEquals($response, "144");
    }

    /**
     * @test
     **/
    public function givenTwoNumbersReturnsTheResultOfTheAddOperation()
    {
        $response = $this->stringCalculator->add("1,2");

        $this->assertEquals("3", $response);
    }

    /**
     * @test
     **/
    public function givenManyNumbersReturnsTheResultOfTheAddOperation()
    {
        $response = $this->stringCalculator->add("1,2,3,4,5");

        $this->assertEquals("15", $response);
    }

    /**
     * @test
     **/
    public function givenManyNumbersSeparatedWithBreakLineReturnsTheResultOfTheAddOperation()
    {
        $response = $this->stringCalculator->add("1,2\n3\n4,5,5");

        $this->assertEquals("20", $response);
    }

    /**
     * @test
     **/
    public function givenANewDelimiterReturnTheResultOfTheAddOperation()
    {
        $response = $this->stringCalculator->add("//;\n1;2;3");

        $this->assertEquals("6", $response);
    }

}