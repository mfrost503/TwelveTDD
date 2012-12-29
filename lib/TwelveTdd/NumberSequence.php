<?php

namespace TwelveTdd;

class NumberSequence
{
    public $sequence = array();

    public function __construct(Array $array=array())
    {
        $this->sequence = $array;
    }

    /**
     * @param $int
     * @return bool
     * @throws \Exception
     * Adds the number to the sequence array
     */
    public function add($int)
    {
        if(!is_int($int)){
            throw new \Exception("Integer must be added");
        }
        $this->sequence[] = $int;
        return true;
    }

    /**
     * @return mixed
     * @throws \Exception
     * Will sort the integers and return the first
     * element from the sorted array, the smallest
     */
    public function minimumValue()
    {
        if(!sort($this->sequence)){
            throw new \Exception("Sorting Failed");
        }
        return array_shift($this->sequence);
    }

    /**
     * @return mixed
     * @throws \Exception
     * Will reverse sort the integers and return the
     * first element from the reverse sorted array, the largest
     */
    public function maximumValue()
    {
        if(!rsort($this->sequence)){
            throw new \Exception("Sorting Failed");
        }
        return array_shift($this->sequence);
    }

    /**
     * @return int
     * Returns a count of the number of elements in the sequence array
     */
    public function count()
    {
        return count($this->sequence);
    }

    /**
     * @return int
     * @throws \Exception
     * Will divide the sum of the values in the sequence
     * by the number of elements in the sequence to return an average value
     */
    public function average()
    {
        $sum = $this->sumElements();
        $count = $this->count();
        if($count == 0){
            throw new \Exception("You have no elements in the sequence");
        }
        return $sum/$count;
    }

    /**
     * @return int
     * Will sum the values provided in the sequence
     */
    public function sumElements()
    {
        $sum = 0;
        foreach($this->sequence as $int) {
            $sum += $int;
        }
        return $sum;
    }
}
