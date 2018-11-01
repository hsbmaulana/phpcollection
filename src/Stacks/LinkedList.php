<?php

declare(strict_types=1);

namespace Collections\Stacks;

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
    * Check whether item given exist or not.
    *
    * @param mixed $item
    * @return bool
    */
    public function contain($item) : bool
    {
        $checker = false;
        $current = $this->head;

        while($current != null) {

            if($current->item == $item) {

                $checker = true;

                break;
            }

            $current = $current->next;
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
        return $this->head == null;
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
    * Get the top item in collection.
    *
    * @return mixed
    */
    public function peek()
    {
        if($this->isNotEmpty()) {

            return $this->foot->item;
        }        
    }

   /**
    * Remove the most recently pushed item in the collection.
    *
    * @return void
    */
    public function pop()
    {
        $current = $this->head;

        if($current === null || $current->next === null) {

            $this->head = null;
            $this->foot = null;
            $this->length = 0;

            return;
        }

        while($current->next != null) {

            $current = $current->next;
        }
        
        $current = $current->previous;
        $current->next = null;

        $this->foot = $current;
        $this->length--;
    }

   /**
    * Add an item onto the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function push($item)
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
}

