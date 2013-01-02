<?php
namespace TwelveTdd;
class FizzBuzz
{
    private $numbers;
    private $output = array();
    public function __construct($numbers)
    {
        $this->numbers = $numbers;
    }

    public function process()
    {
        for($x=1;$x<=$this->numbers;$x++) {
            $this->analyze($x);
        }
        return $this->output;
    }

    public function analyze($number)
    {
        $this->output[$number] = '';

        if($number % 3 == 0) {
            $this->output[$number] = 'Fizz';
        }
        if($number % 5 == 0) {
            $this->output[$number] .= 'Buzz';
        }
        if($this->output[$number] == '') {
            $this->output[$number] = $number;
        }
    }

    public function output()
    {
        foreach($this->output as $output){
            print $output . "\n";
        }
    }
}