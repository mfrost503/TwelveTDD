<?php
namespace TwelveTdd;
interface Range
{
    public function intersection(Range $range);
    public function getArray();
    public function isInRange($number);
}