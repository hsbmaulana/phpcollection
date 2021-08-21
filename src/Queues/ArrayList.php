<?php

declare(strict_types=1);

namespace Collections\Queues;

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
    * Remove the item on the most front in the collection.
    *
    * @return void
    */
    public function dequeue()
    {
        if($this->isNotEmpty()) {

            for($i = 0; $i < count($this->items); $i++) {

                if(!isset($this->items[$i + 1])) {

                    unset($this->items[$i]);

                    break;
                }

                $this->items[$i] = $this->items[$i + 1];
                $this->items[$i + 1] = 0;
            }

            $this->index--;
        }
    }

   /**
    * Add an item onto the end of the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function enqueue($item)
    {
        $this->items[ $this->index ] = $item;

        $this->index++;
    }

   /**
    * Get the most front item in the collection.
    *
    * @return mixed
    */
    public function getFront()
    {
        if($this->isNotEmpty()) {

            return $this->items[ 0 ];
        }        
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
    * Get the most front item and remove it.
    *
    * @return mixed
    */
    public function pool()
    {
        if($this->isNotEmpty()) {

            $item = $this->getFront();
            $this->dequeue();

            return $item;
        }

        return null;
    }
}

