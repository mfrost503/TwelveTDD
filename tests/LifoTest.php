<?php
namespace TwelveTdd;

class LifoTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->lifo = new Lifo();
    }

    public function tearDown()
    {
        unset($this->lifo);
    }

    /**
     * @test
     * Given that strings are added to the Lifo object
     * When we pull the items out
     * Then they should be in the reverse order they were entered
     */
    public function StringsAreRetrievedInReverseOrder()
    {
        $this->lifo->addItem('');
        $this->lifo->addItem("12Tdd");
        $this->lifo->addItem("Matt");
        $this->lifo->addItem("Frost");
        $this->lifo->addItem("is");
        $this->lifo->addItem("doing");
        $this->lifo->addItem("12Tdd");
        $strings = $this->lifo->getItems();
        $this->assertEquals($strings[0],"12Tdd");
        $this->assertEquals($strings[1],"doing");
        $this->assertEquals($strings[2],"is");
        $this->assertEquals($strings[3],"Frost");
        $this->assertEquals($strings[4],"Matt");
    }

    /**
     * @test
     * Given that the stack size is set
     * When the strings are pulled out
     * Then any index higher than the stack size should drop off
     */
    public function VerifyStackSizeIsMaintained()
    {
        $this->lifo->setStackSize(5);
        $this->lifo->addItem('a');
        $this->lifo->addItem('b');
        $this->lifo->addItem('c');
        $this->lifo->addItem('d');
        $this->lifo->addItem('e');
        $this->lifo->addItem('f');
        $strings = $this->lifo->getItems();
        $this->assertEquals('f',$strings[0]);
        $this->assertEquals('b',$strings[4]);
    }

}