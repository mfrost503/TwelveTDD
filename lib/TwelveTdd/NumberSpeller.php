<?php
namespace lib\TwelveTdd;

class NumberSpeller
{
    private $number;
    private $baseNumbers;
    private $string = '';
    private $isTeen = false;
    public function __construct($number)
    {
        $this->number = (string) $number;
        $this->baseNumbers = array(
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety'
        );
        $this->places = array(
            0 => '',
            1 => ' thousand ',
            2 => ' million ',
            3 => 'billion',
            4 => 'trillion'
        );
    }

    public function convert()
    {
        $separations = $this->getSeparations();
        $start = -3;
        $this->padNumber();
        for($x=0; $x < $separations; $x++){
            $separation = substr($this->number,$start,3);
            $this->processSeparation($separation,$x);
            $start += -3;
        }
        $string = trim($this->string);
        return preg_replace('/\s+/',' ',$string);

    }

    /**
     * @return float
     * Returning the number of 3 digit separations
     */
    public function getSeparations()
    {
        $separations = $this->numberCount() / 3;
        return ceil($separations);
    }

    public function numberCount()
    {
        return strlen($this->number);
    }

    private function processSeparation($separation,$placesIndex)
    {
        $this->isTeen = false;
        $string = $this->processHundreds(substr($separation,0,1)) .' ';
        $string .= $this->processTens(substr($separation,1,2)). ' ';
        $string .= $this->processOnes(substr($separation,2,1)). '';
        $places = $this->places[$placesIndex];
        if(!(preg_match('/^\s+$/',$string))){
            $string .= $places;
        }
        $this->string = $string . $this->string;
    }

    private function processHundreds($number)
    {
        if($number !=0) {
            return $this->baseNumbers[$number] .' hundred';
        }
        return '';
    }

    private function processTens($number)
    {
        if(substr($number,0,1) == '1') {
            $this->isTeen = true;
            return $this->baseNumbers[$number];
        }

        if(substr($number,0,1) != '0'){
            $index = substr($number,0,1) . '0';
            return $this->baseNumbers[$index];
        }
        return '';
    }

    private function processOnes($number)
    {
        if($this->isTeen === true) {
            return '';
        }
        if($number != 0) {
            return $this->baseNumbers[$number];
        }
    }

    private function padNumber()
    {
        $separations = $this->getSeparations();
        if($this->numberCount() % 3){
            $length = $separations * 3;
            $this->number = str_pad($this->number,$length,'0',STR_PAD_LEFT);
        }
    }
}