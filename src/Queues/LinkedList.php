<?php

declare(strict_types=1);

namespace Collections\Queues;

use \Exception;
use \Libraries\Materials\Node;

class LinkedList
{
   /**
    * Current node of the collection.
    *
    * @var \Libraries\Materials\Node
    */
    private $current = null;

   /**
    * Latest node of the collection.
    *
    * @var \Libraries\Materials\Node
    */
    private $foot = null;

   /**
    * Lowest node of the collection.
    *
    * @var \Libraries\Materials\Node
    */
    private $head = null;

   /**
    * Length of the nodes in the collection.
    *
    * @var int
    */
    private $length = 0;

   /**
    * Count the number of items of the collection.
    *
    * @return int
    */
    public function count() : int
    {
        return $this->length;
    }

   /**
    * Remove the item on the most front in the collection.
    *
    * @return void
    */
    public function dequeue()
    {
        if($this->head === null || $this->head->next === null) {

            $this->head = null;
            $this->foot = null;
            $this->length = 0;

            return;
        }

        $current = $this->head->next;
        $current->previous = null;
        $this->head = $current;

        $this->length--;
    }

   /**
    * Add an item onto the end of the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function enqueue($item)
    {
        if($this->head === null) {

            $this->head = new Node($item);
            $this->foot = $this->head;

            $this->head->previous = null;
            $this->head->next = null;

            $this->length++;

            return;
        }

        $current = $this->head;

        while($current->next != null) {

            $current = $current->next;
        }

        $previous = $current;
        $current->next = new Node($item);
        $current->next->previous = $previous;
        $this->foot = $current->next;

        $this->length++;
    }

   /**
    * Get the most front item in the collection.
    *
    * @return mixed
    */
    public function getFront()
    {
        if($this->isNotEmpty()) {

            return $this->head->item;
        }    
    }

   /**
    * Determine if the collection is empty or not.
    *
    * @return bool
    */
    public function isEmpty()
    {
        if($this->head === null) {
            
            return true;
        }

        return false;
    }

   /**
    * Determine if the collection is not empty.
    *
    * @return bool
    */
    public function isNotEmpty()
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

