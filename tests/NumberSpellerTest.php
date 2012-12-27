<?php
use \lib\TwelveTdd as lib;

class NumberSpellerTest extends PHPUnit_Framework_TestCase
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
            array(100145,'one hundred thousand one hundred forty five')
        );
    }

    /**
     * @dataProvider numberProvider
     *
     */
    public function testValidNumbers($number, $text)
    {
        $ns = new lib\NumberSpeller($number);
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
        $ns = new lib\NumberSpeller($number);
        $this->assertEquals($separations,$ns->getSeparations());
        unset($ns);
    }

    /**
     * @test
     * Given a single digit number is provided
     * When the convert method is called
     * Then the number should be spelled out correctly
     */
    public function singleDigitNumberReturnsCorrectly()
    {
        $ns = new lib\NumberSpeller(3);
        $this->assertEquals('three',strtolower($ns->convert()));
    }
}
