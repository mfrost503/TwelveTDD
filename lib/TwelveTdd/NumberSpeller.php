<?php
namespace lib\TwelveTdd;

class NumberSpeller
{
    private $number;
    private $baseNumbers;
    private $string = '';
    private $places;
    private $isTeen = false;

    /**
     * @param $number
     * Setting base numbers with the least amount of number texts
     * possible to avoid crazy extrapolations
     * We're also going to cast the number to a string
     */
    public function __construct($number)
    {
        $this->number = str_replace(',','',$number);
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
            3 => ' billion ',
            4 => ' trillion '
        );
    }

    /**
     * @return mixed
     * We're going to start from the right and break the
     * number into 3 digit place separations (hundreds,thousands,millions,etc)
     * and process them to generate the text
     */
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
        // cleaning up some formatting with extra spaces....way easier
        return preg_replace('/\s+/',' ',$string);

    }

    /**
     * @return float
     * This is going to tell us how many 3 digit
     * separations we actually have
     */
    public function getSeparations()
    {
        $separations = $this->numberCount() / 3;
        return ceil($separations);
    }

    /**
     * @return int
     * tells us how many digits we have
     */
    public function numberCount()
    {
        return strlen($this->number);
    }

    /**
     * @param $separation
     * @param $placesIndex
     * Then teen numbers require a little bit of trickery, so on every
     * separation we need to check if we have a teen number
     */
    private function processSeparation($separation,$placesIndex)
    {
        $this->isTeen = false;
        $string = $this->processHundreds(substr($separation,0,1)) .' ';
        $string .= $this->processTens(substr($separation,1,2)). ' ';
        $string .= $this->processOnes(substr($separation,2,1)). '';
        $places = $this->places[$placesIndex];
        // if the string is nothing but spaces, there is no value for the separation
        if(!(preg_match('/^\s+$/',$string))){
            $string .= $places;
        }
        $this->string = $string . $this->string;
    }

    /**
     * @param $number
     * @return string
     * Gets the left-most number of the separation and returns
     * {\d} hundred if that number is not zero
     */
    private function processHundreds($number)
    {
        if($number !=0) {
            return $this->baseNumbers[$number] .' hundred';
        }
        return '';
    }

    /**
     * @param $number
     * @return string
     * Needed the 2 right most numbers to accommodate a teen
     * if it's not a teen or 0 we return the first of the 2 numbers
     * with a zero appended
     */
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

    /**
     * @param $number
     * @return string
     * If we had a teen in the previous step we don't have
     * to address this number, otherwise, we're able to just pull
     * the text for the number.
     */
    private function processOnes($number)
    {
        if($this->isTeen === true) {
            return '';
        }
        if($number != 0) {
            return $this->baseNumbers[$number];
        }
    }

    /**
     * In order to get nice clean separations, if we don't have a
     * factor of three, we're going to pad it with zeros, so 1000 will become
     * 001000
     */
    private function padNumber()
    {
        $separations = $this->getSeparations();
        if($this->numberCount() % 3){
            $length = $separations * 3;
            $this->number = str_pad($this->number,$length,'0',STR_PAD_LEFT);
        }
    }
}