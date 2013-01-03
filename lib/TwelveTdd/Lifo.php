<?php

namespace TwelveTdd;

class Lifo
{
    private $stack = array();
    private $stackSize = null;
    public function addItem($item)
    {
        if(empty($item)){
            return false;
        }
        if(in_array($item,$this->stack)){
            unset($this->stack[array_search($item,$this->stack)]);
        }
        array_unshift($this->stack,$item);
        $this->stack = array_slice($this->stack,0,$this->stackSize);
        return true;
    }

    public function getItems()
    {
        return $this->stack;
    }

    public function setStackSize($size)
    {
        $this->stackSize = $size;
    }

    public function getStackSize()
    {
        return $this->stackSize;
    }
}