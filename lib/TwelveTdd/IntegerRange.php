<?php
namespace TwelveTdd;

class IntegerRange implements Range
{
    private $numbers = array();
    public function __construct($start,$end)
    {
        for($x=$start;$x<=$end;$x++) {
            $this->numbers[] = $x;
        }
    }
    public function intersection(Range $range)
    {
        $rangeArray = $range->getArray();
        $difference = array_diff($this->numbers,$rangeArray);
        return array_values(array_diff($this->numbers,$difference));
    }

    public function getArray()
    {
        return $this->numbers;
    }

    public function isInRange($number)
    {
        if(in_array($number,$this->numbers)){
            return true;
        }
        return false;
    }
}