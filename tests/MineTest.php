<?php
use \lib\TwelveTdd as lib;

class MineTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }
    public function tearDown()
    {

    }

    /**
     * @test
     * Given that a grid is provided
     * When the Mine class is instantiated
     * Then verify it is a valid grid structure
     */
    public function GridIsValid()
    {
        $mine = new lib\Mine(1,8,'....*...');
        $this->assertInstanceOf('lib\TwelveTdd\Mine',$mine);
    }

    /**
     * @test
     * Given that an empty string is provided
     * When the Mine class is instantiated
     * Then an Exception should be thrown
     * @expectedException \Exception
     * @expectedExceptionMessage Grid cannot be empty
     */
    public function EmptyGridThrowsException()
    {
        $mine = new lib\Mine(3,5,'');
    }

    /**
     * @test
     * Given that an empty string is provided
     * When the Mine class is instantiated
     * Then an Exception should be thrown
     * @expectedException \Exception
     * @expectedExceptionMessage Grid cannot be empty
     */
    public function EmptyArrayGridThrowsException()
    {
        $mine = new lib\Mine(1,1,array());
    }

    /**
     * @test
     * Given that an integer is provided
     * When the Mine class is instantiated
     * Then an Exception should be thrown
     * @expectedException \Exception
     * @expectedExceptionMessage Grid must be string or array
     */
    public function IntGridThrowsException()
    {
        $mine = new lib\Mine(1,1,2);
    }

    /**
     * @test
     * Given that there is a grid
     * When isPositionValid is called
     * Then true should be returned for positions on the grid
     * and false should be returned for positions not on the grid
     */
    public function CheckValidPositions()
    {
        $grid = "...\n...\n...\n";
        $mine = new lib\Mine(3,3,$grid);
        $mine->generateRows();
        $this->assertTrue($mine->isPositionValid(3,1));
        $this->assertTrue($mine->isPositionValid(1,2));
        $this->assertFalse($mine->isPositionValid(4,4));
        $this->assertFalse($mine->isPositionValid(0,2));
    }

    /**
     * @test
     * Given that there is a grid
     * When isMine is called
     * Then true should be returned if the character is *
     * and false should be returned otherwise
     */
    public function CheckIsMine()
    {
        $grid = "..*\n.*.\n*..";
        $mine = new lib\Mine(3,3,$grid);
        $mine->generateRows();
        $this->assertTrue($mine->isMine(1,2));
        $this->assertTrue($mine->isMine(2,1));
        $this->assertTrue($mine->isMine(3,0));
        $this->assertFalse($mine->isMine(1,0));
    }

    /**
     * @test
     * Given there is a grid
     * When the generate rows method is called
     * Then positions should have the number of adjacent mines
     */
    public function CheckAdjacentMines()
    {
        $grid = "...*.\n.*...\n..*..\n....*\n.....";
        $mine = new lib\Mine(5,5,$grid);
        $mine->generateRows();
        $output = $mine->process();
        $this->assertEquals('112*1',$output[1]);
        $this->assertEquals('1*321',$output[2]);
        $this->assertEquals('12*21',$output[3]);
        $this->assertEquals('0112*',$output[4]);
        $this->assertEquals('00011',$output[5]);
    }
}