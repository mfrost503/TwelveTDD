<?php
namespace TwelveTdd;

class IntegerRangeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->range = new IntegerRange(0,10);
    }

    public function tearDown()
    {
        unset($this->range);
    }

    /**
     * @test
     * Given that we set a range
     * When getArray is called
     * Then an array with numbers should be returned
     */
    public function GetArrayReturnsArrayOfNumbers()
    {
        $testArray = array(0,1,2,3,4,5,6,7,8,9,10);
        $this->assertEquals($testArray,$this->range->getArray());
    }

    /**
     * @test
     * Given 2 ranges
     * When intersect is called
     * Then the intersection of those 2 ranges should be returned as an array
     */
    public function IntersectReturnsIntersectionAsArray()
    {
        $range1 = new IntegerRange(7,10);
        $expectedIntersection = array(7,8,9,10);
        $intersection = $this->range->intersection($range1);
        $this->assertEquals($expectedIntersection,$intersection);
    }

    /**
     * @test
     * Given there is a range from 0-10
     * When checking to see if a number is in the range
     * Then true should be returned if in range, false otherwise
     */
    public function CheckIsInRange()
    {
        $this->assertTrue($this->range->isInRange(9));
        $this->assertFalse($this->range->isInRange(11));

    }

}