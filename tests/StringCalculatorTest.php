<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\NegativeNotAllowedException;
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
     *
     * @throws NegativeNotAllowedException
     */
    public function givenAnEmptyStringReturns()
    {
        $result = $this->stringCalculator->add("");

        $this->assertEquals("0", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenOneNumberReturnsTheNumber()
    {
        $result = $this->stringCalculator->add("144");

        $this->assertEquals("144", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenTwoNumbersReturnsTheResultOfTheAddOperation()
    {
        $result = $this->stringCalculator->add("1,2");

        $this->assertEquals("3", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenManyNumbersReturnsTheResultOfTheAddOperation()
    {
        $result = $this->stringCalculator->add("1,2,3,4,5");

        $this->assertEquals("15", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenManyNumbersSeparatedWithBreakLineReturnsTheResultOfTheAddOperation()
    {
        $result = $this->stringCalculator->add("1,2\n3\n4,5,5");

        $this->assertEquals("20", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenANewDelimiterReturnTheResultOfTheAddOperation()
    {
        $result = $this->stringCalculator->add("//;\n1;2;3");

        $this->assertEquals("6", $result);
    }

    /**
     * @test
     **/
    public function givenOneNegativeNumberReturnsAnException()
    {
        $this->expectException(NegativeNotAllowedException::class);
        $this->expectExceptionMessage("Negative not allowed: -1");

        $this->stringCalculator->add("-1");
    }

    /**
     * @test
     **/
    public function givenSomeNegativeNumberReturnsAnException()
    {
        $this->expectException(NegativeNotAllowedException::class);
        $this->expectExceptionMessage("Negative not allowed: -1,-3,-4");

        $this->stringCalculator->add("-1,2,-3,-4");
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenANumberBiggerThanOneThousand()
    {
        $result = $this->stringCalculator->add("2,1001");

        $this->assertEquals("2", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenSomeNumbersBiggerThanTheLimit()
    {
        $result = $this->stringCalculator->add("2090,1001,2");

        $this->assertEquals("2", $result);
    }

    /**
     * @test
     *
     * @throws NegativeNotAllowedException
     */
    public function givenADelimiterWithMoreLengthThanOneCharacter()
    {
        $result = $this->stringCalculator->add("//[***]\n1***2***3");

        $this->assertEquals("6", $result);
    }


}