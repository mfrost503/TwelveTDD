<?php

namespace TwelveTdd;

class NumberSpellerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp(){}
    public function tearDown(){}

    public function separationProvider()
    {
        return array(
            array(100000,2),
            array(1000000,3),
            array(1,1),
            array(1000,2),
            array(1000000000,4)
        );
    }

    public function numberProvider()
    {
        return array(
            array(12,'twelve'),
            array(19,'nineteen'),
            array(100,'one hundred'),
            array(165,'one hundred sixty five'),
            array(1000, 'one thousand'),
            array(1100, 'one thousand one hundred'),
            array(1100100,'one million one hundred thousand one hundred'),
            array(1013,'one thousand thirteen'),
            array(100000000000, 'one hundred billion'),
            array(100145,'one hundred thousand one hundred forty five'),
            array('1,045','one thousand forty five'),
            array(1000001,'one million one'),
            array('143,865,030,112,068','one hundred forty three trillion eight hundred sixty five billion thirty million one hundred twelve thousand sixty eight'),
            array('143,000,000,000,000,000,000,000,000,000,000,012','one hundred forty three decillion twelve'),
        );
    }

    /**
     * @dataProvider numberProvider
     *
     */
    public function testValidNumbers($number, $text)
    {
        $ns = new NumberSpeller($number);
        $this->assertEquals($text,$ns->convert());
    }

    /**
     *
     * Given a number is provided
     * When getSeparations is called
     * Then the number of 3 digit separations should be returned
     * @dataProvider separationProvider
     */
    public function getThreeDigitSeparations($number,$separations)
    {
        $ns = new NumberSpeller($number);
        $this->assertEquals($separations,$ns->getSeparations());
        unset($ns);
    }

    /**
     * @test
     * Given that a number is provided
     * When the numberCount method is called
     * Then we should get the number of digits provided
     */
    public function getCorrectNumberCount()
    {
        $ns = new NumberSpeller(120);
        $this->assertEquals(3,$ns->numberCount());
        $ns1 = new NumberSpeller(10000123);
        $this->assertEquals(8,$ns1->numberCount());
    }

    /**
     * @test
     * Given a single digit number is provided
     * When the convert method is called
     * Then the number should be spelled out correctly
     */
    public function singleDigitNumberReturnsCorrectly()
    {
        $ns = new NumberSpeller(3);
        $this->assertEquals('three',strtolower($ns->convert()));
    }
}
