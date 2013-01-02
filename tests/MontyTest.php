<?php
namespace TwelveTdd;
class MontyTest extends \PHPUnit_Framework_TestCase
{
    private $iterations;
    protected $monty;
    public function setUp()
    {
        $this->monty = new Monty();
        $this->monty->setDoors(array("car","goat","goat"));
        $this->iterations = 1000;

    }

    public function tearDown()
    {
        unset($this->monty);
    }

    /**
     * @test
     * Given that there is a monty object with doors
     * When the makeChoice method is a called
     * Then an integer should be returned
     */
    public function VerifyChoiceIsInteger()
    {
        $choice = $this->monty->makeChoice();
        $this->assertTrue(is_int($choice));
    }

    /**
     * @test
     * Given there is a monty object with doors
     * When the selectGoat method is called
     * Then the value goat should be returned
     */
    public function VerifySelectGoatReturnsGoat()
    {
        $choice = $this->monty->makeChoice();
        $nextDoor = $this->monty->selectGoat($choice);
        $this->assertTrue(is_int($nextDoor));
    }

    /**
     * @test
     * Given there is a monty object
     * When we run a thousand scenarios with no changing
     * Then we should get a win count and win % of less than 0.37;
     */
    public function VerifyRunningScenarioSetsWinsNoChange()
    {
        for($x=0;$x<$this->iterations;$x++) {
            $this->monty->playGame();
        }
        $this->assertTrue(is_int($this->monty->wins));
        $this->assertLessThan(0.37,$this->monty->wins/$this->iterations);
    }

    /**
     * @test
     * Given there is a monty object
     * When we run a thousand scenarios with no changing
     * Then we should get a win count and win % of less than 0.37;
     */
    public function VerifyRunningScenarioSetsWinsWithChange()
    {
        for($x=0;$x<$this->iterations;$x++) {
            $this->monty->playGame(true);
        }
        $this->assertTrue(is_int($this->monty->wins));
        $this->assertGreaterThan(0.63,$this->monty->wins/$this->iterations);
    }
}