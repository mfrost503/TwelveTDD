<?php

use \lib\TwelveTdd as lib;

class NumberSequenceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    /**
     * @test
     * Given that a NumberSequence Instance exists
     * When a number is added to the sequence
     * Then it should be available in the sequence
     */
    public function addNumberToSequence()
    {
        $ns = new lib\NumberSequence();
        $ns->add(3);
        $this->assertTrue(in_array(3,$ns->sequence));
    }

    /**
     * @test
     * Given that a sequence of numbers is provided
     * When the minimumValue method is called
     * Then the smallest integer in the sequence should be returned
     */
    public function getMinimumValue()
    {
        $ns = new lib\NumberSequence();
        $ns->add(1);
        $ns->add(2);
        $ns->add(3);
        $ns->add(4);
        $ns->add(-5);
        $this->assertEquals(-5,$ns->minimumValue());
    }

    /**
     * @test
     * Given that a sequence of numbers is provided
     * When the maximumValue method is called
     * Then the largest integer in the sequence should be returned
     */
    public function getMaximumValue()
    {
        $ns = new lib\NumberSequence();
        $ns->add(1);
        $ns->add(2);
        $ns->add(3);
        $ns->add(4);
        $ns->add(5);
        $this->assertEquals(5,$ns->maximumValue());
    }

    /**
     * @test
     * Given that a sequence of numbers is provided
     * When the count method is called
     * Then we should get the number of integers in the sequence
     */
    public function getElementCount()
    {
        $ns = new lib\NumberSequence();
        $ns->add(1);
        $ns->add(2);
        $this->assertEquals(2,$ns->count());
        $ns->add(3);
        $ns->add(4);
        $this->assertEquals(4,$ns->count());
    }

    /**
     * @test
     * Given a sequence of numbers
     * When the average method is called
     * Then the average the numbers in the sequence should be returned
     */
    public function getElementAverage()
    {
        $ns = new lib\NumberSequence();
        $ns->add(1);
        $ns->add(2);
        $ns->add(3);
        $ns->add(4);
        $ns->add(-5);
        $this->assertEquals(1,$ns->average());
    }

}