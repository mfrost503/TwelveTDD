<?php
namespace lib\TwelveTdd;

class Mine{

    private $grid;
    private $rows = array();
    private $rowCount;
    private $columnCount;
    private $output = array();

    public function __construct($rows,$columns,$grid)
    {
        if(!is_int($rows)){
            throw new \Exception('Rows param must be integer');
        }

        if(!is_int($columns)){
            throw new \Exception("Columns param must be integer");
        }
        if(empty($grid)){
            throw new \Exception("Grid cannot be empty");
        }

        if(!is_string($grid) && !is_array($grid)) {
            throw new \Exception("Grid must be string or array");
        }

        $this->grid = $grid;
        $this->rowCount = $rows;
        $this->columnCount = $columns;
    }

    public function generateRows()
    {
        if(is_string($this->grid)) {
            return $this->generateStringRows();
        }
        return $this->generateArrayRows();

    }

    private function generateStringRows()
    {
        $rows = explode("\n",$this->grid);
        $x=1;
        foreach($rows as $row) {
            $this->rows[$x] = $row;
            $x++;
        }
        return;
    }

    private function generateArrayRows()
    {
        $x = 1;
        foreach($this->grid as $row) {
            $this->rows[$x] = $row;
            $x++;
        }
        return;
    }

    public function process()
    {
        for($x=1; $x <= $this->rowCount; $x++){
            $this->getHints($x);
        }
        return $this->output;
    }

    public function getHints($rowNumber)
    {
        $this->output[$rowNumber] = '';
        for($x=0; $x<$this->columnCount;$x++){
            $this->processHint($rowNumber,$x);
        }
    }

    private function processHint($rowNumber,$position)
    {

        $count =0;
        $rowUp = $rowNumber - 1;
        $rowDown = $rowNumber + 1;
        $columnLeft = $position - 1;
        $columnRight = $position + 1;
        if(substr($this->rows[$rowNumber],$position,1) == "*") {
            $this->output[$rowNumber] .= "*";
            return;
        }
        // to the right, make sure we're not in last column
        if($this->isPositionValid($rowNumber,$columnRight) && $this->isMine($rowNumber,$columnRight)) {
            $count++;
        }
        // to the left make sure we're not in first column
        if($this->isPositionValid($rowNumber,$columnLeft) && $this->isMine($rowNumber,$columnLeft)){
            $count++;
        }
        // below make sure we're not on bottom row
        if($this->isPositionValid($rowDown,$position) && $this->isMine($rowDown,$position)){
            $count++;
        }
        // above make sure we're not on top row
        if($this->isPositionValid($rowUp,$position) && $this->isMine($rowUp,$position)) {
            $count++;
        }
        if($this->isPositionValid($rowDown,$columnRight) && $this->isMine($rowDown,$columnRight)) {
            $count++;
        }
        if($this->isPositionValid($rowDown,$columnLeft) && $this->isMine($rowDown,$columnLeft)){
            $count++;
        }
        if($this->isPositionValid($rowUp,$columnRight) && $this->isMine($rowUp,$columnRight)) {
            $count++;
        }
        if($this->isPositionValid($rowUp,$columnLeft) && $this->isMine($rowUp,$columnLeft)) {
            $count++;
        }
        $this->output[$rowNumber] .= $count;
        return;
    }

    public function isPositionValid($row,$position)
    {
        if($row > $this->rowCount) {
            return false;
        }

        if($row < 1) {
            return false;
        }

        if($position > $this->columnCount){
            return false;
        }

        if($position < 0) {
            return false;
        }
        return true;
    }

    public function isMine($row, $position)
    {
        if(!isset($this->rows[$row])) {
            return false;
        }
        if(substr($this->rows[$row],$position,1) == '*') {
            return true;
        }

        return false;
    }

}