<?php

declare(strict_types=1);

namespace Collections\Lists;

use \Exception;

class ArrayList
{
   /**
    * The items contained in the collection.
    *
    * @var array
    */
    private $items = array();

   /**
    * Create a new list collection.
    *
    * @param mixed $items
    * @return void
    */
    public function __construct($items = [])
    {
        if(is_array($items)) {
        
            $this->combine($items);
        } else {

            $this->add($items);
        }
    }

   /**
    * Adding an item to the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function add($item)
    {
        $this->items[] = $item;
    }

   /**
    * Chunk the items by given size.
    *
    * @param int $size
    * @return void
    */
    public function chunk(int $size)
    {
        $items = array();
        $modulus = count($this->items) % $size;

        $index = ($modulus === 0) ?
        count($this->items) / $size
        :
        ((count($this->items) - $modulus) / $size) + 1;

        $start = 0;

        for($i = 0; $i < $index; $i++) {

            $j = 0;
            $end = $start + $size;

            for( ;$start < $end; $start++ ) {

                if(!isset($this->items[$start])) {

                    break;
                }

                $items[$i][$j] = $this->items[$start];

                $j++;
            }
        }

        $this->reset();
        $this->items = $items;
    }

   /**
    * Collapse all of subbed-dimension of items to single.
    *
    * @return void
    */
    public function collapse()
    {
        $baserange = count($this->items);
        $items = array();
        $hasarray = 0;

        for($i = 0; $i < $baserange; $i++) {

            if(!is_array($this->items[$i])) {

                $items[] = $this->items[$i];
                continue;
            }

            for($j = 0; $j < count($this->items[$i]); $j++) {

                $items[] = $this->items[$i][$j];

                if(is_array($this->items[$i][$j])) {

                    $hasarray = 1;
                } else {

                    $hasarray = 0;
                }
            }
        }

        $this->reset();
        $this->items = $items;

        if($hasarray == 1) {

            $this->collapse();
        }
    }

   /**
    * Combine given array to existed items.
    *
    * @param array $items
    * @return void
    */
    public function combine(array $items)
    {
        foreach($items as $item) {

            $this->items[] = $item;
        }
    }

   /**
    * Count the number of items in the collection.
    *
    * @return int
    */
    public function count() : int
    {
        return count($this->items);
    }

   /**
    * Dump list of the collection.
    *
    * @return void
    */
    public function dump()
    {
        var_dump($this->getAll());
    }

   /**
    * Give an action to each items in the collection.
    *
    * @param \Closure $callback
    * @return void
    */
    public function each(\Closure $callback)
    {
        foreach($this->items as $item) {

            $callback($item);
        }
    }

   /**
    * Get an item in the collection by given index.
    *
    * @param int $index
    * @return mixed
    */
    public function get(int $index)
    {
        return $this->items[ $index ];
    }

   /**
    * Get the RAW items of the list collection.
    *
    * @return array
    */
    public function getAll() : array
    {
        return $this->items;
    }

   /**
    * Determine if the collection is empty or not.
    *
    * @return bool
    */
    public function isEmpty() : bool
    {
        return empty($this->items);
    }

   /**
    * Determine if the collection is not empty.
    *
    * @return bool
    */
    public function isNotEmpty() : bool
    {
        return !$this->isEmpty();
    }

   /**
    * Get all of lost values in the collection.
    *
    * @return array
    */
    public function lose() : array
    {
        if($this->type() !== "integer") {

            throw new Exception("All values of the collection must be an integer");

            return [];
        }

        $items = array();
        $less = 0;

        for($i = 0; $i < count($this->items); $i++) {

            if(!isset($this->items[$i + 1])) { break; };

            if($this->items[$i] <= $this->items[$i + 1]) {

                if($this->items[$i] + 1 != $this->items[$i + 1]) {

                    $less = 1;

                    for($j = $this->items[$i] + 1;
                        $j < $this->items[$i + 1];
                        $j++) {

                            $items[] = $j;
                        }
                }

            } else {

                $less = 0;

                throw new Exception("All values must be ordered");

                return [];
            }
        }

        return $items;       
    }

   /**
    * Get maximum value in the list of collection.
    *
    * @return int
    */
    public function getMax() : int
    {
        if($this->type() !== "integer") {

            throw new Exception("All values of the collection must be an integer");

            return -1;
        }

        $found = $this->items[0];
        $index = 0;

        for($i = 1; $i < count($this->items); $i++) {

            if($this->items[$i] > $found) {

                $found = $this->items[$i];
                $index = $i;
            }
        }

        return $index;        
    }

   /**
    * Get minimum value in the list of collection.
    *
    * @return int
    */
    public function getMin() : int
    {
        if($this->type() !== "integer") {

            throw new Exception("All values of the collection must be an integer");

            return -1;
        }

        $found = $this->items[0];
        $index = 0;

        for($i = 1; $i < count($this->items); $i++) {

            if($this->items[$i] < $found) {

                $found = $this->items[$i];
                $index = $i;
            }
        }

        return $index;
    }

   /**
    * Modify item in the collection by given index.
    *
    * @param int $index
    * @param mixed $value
    * @return void
    */
    public function modify(int $index, $value)
    {
        if(isset($this->items[$index])) {

            $this->items[$index] = $value;
        }
    }

   /**
    * Remove an item in the collection by given index.
    * 
    * @param int $index
    * @return void
    */
    public function remove(int $index)
    {
        if(!isset($this->items[$index])) {

            throw new Exception("Item on the index is not found");

            return;
        }        

        if(!isset($this->items[$index + 1])) {
            
            unset($this->items[$index]);
        } else {

            for($i = $index; $i < count($this->items); $i++) {

                if(!isset($this->items[$i + 1])) {

                    unset($this->items[$i]);
                    break;
                }

                $this->items[$i] = $this->items[$i + 1];
                $this->items[$i + 1] = 0;
            }
        }
    }

   /**
    * Clear items in the list collection.
    *
    * @return void
    */
    public function reset()
    {
        $this->items = null;
        $this->items = array();
    }

   /**
    * Search an item from the collection by given chain method.
    *
    * @return \Libraries\Algorithms\ArraySearch
    */
    public function search() : \Libraries\Algorithms\ArraySearch
    {
        return new \Libraries\Algorithms\ArraySearch($this->items);
    }

   /**
    * Sort the list of collection by given chain method.
    *
    * @return \Libraries\Algorithms\ArraySort
    */
    public function sort() : \Libraries\Algorithms\ArraySort
    {
        return new \Libraries\Algorithms\ArraySort($this->items);
    }

   /**
    * Get type of each items in the collection.
    *
    * @return mixed
    */
    public function type()
    {
        $items = array();
        $one = 0;

        foreach($this->items as $key => $value) {

            $items[$key] = gettype($value);
        }

        for($i = 0; $i < count($this->items); $i++) {

            if(isset($items[ $i + 1 ])) {

                if($items[ $i + 1 ] === $items[$i]) {

                    $one = 1;
                } else {

                    $one = 0;
                    break;
                }
            } else {

                break;
            }
        }

        if($one === 0) {            

            return $items;
        }

        return $items[0];
    }
}

