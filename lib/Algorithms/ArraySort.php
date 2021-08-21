<?php

declare(strict_types=1);

namespace Libraries\Algorithms;

use \Exception;

class ArraySort
{
   /**
    * The items list to sort.
    *
    * @var array
    */
    private $items = array();

   /**
    * Create an item as list.
    *
    * @param array $items
    * @return void
    */
    public function __construct(array $items)
    {
        $this->items = $items;

        foreach($this->items as $item) {

            if(!is_numeric($item)) {

                throw new Exception("All of item need to be numeric data type");

                return;
            }
        }
    }

   /**
    * Sort the items by bubble sort algorithm.
    *
    * @return array
    */
    public function byBubble() : array
    {
        for($i = count($this->items) - 1; $i >= 0; $i--) {

            for($j = 0; $j <= $i; $j++) {

                if(!isset($this->items[$j + 1])) { break; };

                if($this->items[$j + 1] < $this->items[$j]) {

                    $backup = $this->items[$j];
                    $this->items[$j] = $this->items[$j + 1];
                    $this->items[$j + 1] = $backup;
                }
            }
        }

        return $this->items;
    }

   /**
    * Sort the items by insertion sort algorithm.
    *
    * @return array
    */
    public function byInsertion() : array
    {
        for($i = 1; $i < count($this->items); $i++) {

            $offset = $i - 1;

            if($this->items[$i] < $this->items[$offset]) {

                $backup = $this->items[$offset];
                $this->items[$offset] = $this->items[$i];
                $this->items[$i] = $backup;

                for($j = $offset; $offset >= 0; $j--) {

                    if(!isset($this->items[$j - 1])) { break; }

                    if($this->items[$j] < $this->items[$j - 1]) {

                        $bckp = $this->items[$j - 1];
                        $this->items[$j - 1] = $this->items[$j];
                        $this->items[$j] = $bckp;
                    }
                }
            }
        }

        return $this->items;
    }

   /**
    * Sort the items by selection sort algorithm.
    *
    * @return array
    */
    public function bySelection() : array
    {
        for($i = 0; $i < count($this->items) - 1; $i++) {

            $min = $this->items[$i];
            $onindex = 0;
            
            for($j = $i+1; $j < count($this->items); $j++) {

                if($this->items[$j] < $min) {

                    $min = $this->items[$j];
                    $onindex = $j;
                }
            }

            if($min != $this->items[$i]) {

                $backup = $this->items[$i];
                $this->items[$i] = $min;
                $this->items[$onindex] = $backup;
            }
        }

       return $this->items;
    }
}

