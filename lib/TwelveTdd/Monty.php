<?php
namespace TwelveTdd;

class Monty {

    protected $doors = array();
    public $wins = 0;

    public function setDoors(Array $doors)
    {
        $this->doors = $doors;
    }

    public function makeChoice()
    {
        if(empty($this->doors)) {
            throw new \Exception("Doors have to be set before you can choose a door");
        }
        return array_rand($this->doors);
    }

    public function selectGoat($choice)
    {
        // pull out the choice and get all the doors that still have goats
        $remaining = array_diff_key($this->doors,array($choice => ''));
        $goats = array_keys($remaining,'goat');
        //in the event the user chooses the car, we'll just return one goat
        return $goats[array_rand($goats)];
    }

    public function playGame($switch = false)
    {
        shuffle($this->doors);
        $contestantChoice = $this->makeChoice();
        $host = $this->selectGoat($contestantChoice);
        if($switch) {
            $contestantChoice = $this->switchDoors($contestantChoice,$host);
        }
        if($this->doors[$contestantChoice] == 'car') {
            $this->wins++;
        }
    }

    private function switchDoors($contestant,$host)
    {
        $lastChoice = array_diff_key($this->doors,array($contestant => '', $host => ''));
        return array_rand($lastChoice);
    }
}