<?php

namespace TwelveTdd;

class Lifo
{
    private $stack = array();

    public function addItem($item)
    {
        if(empty($this->stack)){
            $this->stack[] = $item;
            return true;
        }
        if(in_array($item,$this->stack)){
            unset($this->stack[array_search($item,$this->stack)]);
        }
        array_unshift($this->stack,$item);
        return true;
    }

    public function getItems()
    {
        return $this->stack;
    }
}