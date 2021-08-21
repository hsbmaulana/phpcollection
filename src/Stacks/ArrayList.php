<?php

declare(strict_types=1);

namespace Collections\Stacks;

use \Exception;

class ArrayList
{
   /**
    * The current index iteration of items in the collection.
    *
    * @var int
    */
    private $index = 0;

   /**
    * The items contained in the collection.
    *
    * @var array
    */
    private $items = array();

   /**
    * Count the number of items of the collection.
    *
    * @return int
    */
    public function count() : int
    {
        return $this->index;
    }

   /**
    * Check whether item given exist or not.
    *
    * @param mixed $item
    * @return bool
    */
    public function contain($item) : bool
    {
        $checker = false;

        foreach($this->items as $object) {

            if($object == $item) {

                $checker = true;

                break;
            }
        }

        return $checker;
    }

   /**
    * Determine if the collection is empty or not.
    *
    * @return bool
    */
    public function isEmpty() : bool
    {
        return $this->count() == 0;
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
    * Get the top item in the collection.
    *
    * @return mixed
    */
    public function peek()
    {
        if($this->isNotEmpty()) {

            return $this->items[ $this->count() - 1 ];
        }
    }    

   /**
    * Remove the most recently pushed item in the collection.
    *
    * @return void
    */
    public function pop()
    {
        if($this->isNotEmpty()) {

            unset( $this->items[ $this->count() - 1 ] );

            $this->index--;
        }
    }

   /**
    * Add an item onto the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function push($item)
    {
        $this->items[ $this->index ] = $item;
        $this->index++;
    }
}

