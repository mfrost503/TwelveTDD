<?php
namespace TwelveTdd;

class FizzBuzzTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fizzbuzz = new FizzBuzz(100);
    }

    public function tearDown()
    {
        unset($this->fizzbuzz);
    }

    public function numberProvider()
    {
        return array(
            array(1,1),
            array(3,'Fizz'),
            array(5,'Buzz'),
            array(15,'FizzBuzz'),
            array(4,4),
            array(100,'Buzz'),
            array(33,'Fizz'),
            array(42,'Fizz')
        );
    }
    /**
     * @test
     * Given that we instantiate a fizz buzz object
     * When we run process
     * Then we expect numbers equally divisible by 3 to output fizz
     * numbers equally divisible by 5 to output buzz
     * and the opposite case to output the number
     * @dataProvider numberProvider
     */
    public function VerifyNumbersAreChangedAccurately($index,$expectedValue)
    {
        $output = $this->fizzbuzz->process();
        $this->assertEquals($output[$index],$expectedValue);
    }
}
