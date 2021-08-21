<?php

declare(strict_types=1);

namespace Collections\Lists;

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
    * Create a new list collection.
    *
    * @param mixed $items
    * @return void
    */
    public function __construct($items = null)
    {
        if($items instanceof Node) {

            $this->combine($items);
        } else {

            $this->add($items);
        }
    }

   /**
    * Material node extension.
    *
    * @param mixed $item
    * @return \Libraries\Materials\Node
    */
    private function __material__($item) : Node
    {    
        return new class($item) extends Node
        {
           /**
            * Create an anonymous material node extension.
            *
            * @param mixed $item
            * @return void
            */
            public function __construct($item)
            {
                parent::__construct($item);                
            }

           /**
            * Modify item in the collection by state of iterator.
            *
            * @param mixed $item
            * @return void
            */
            public function modify($item)
            {        
                $this->item = $item;
            }

           /**
            * Remove a node in the collection by state of iterator.
            *
            * @return void
            */
            public function remove()
            {
                if($this->previous != null) {

                    $current = &$this->previous->next;

                    if($this->next != null) {

                        $next = $this->next;
                        $previous = $this->previous;

                        $current = $next;
                        $current->previous = $previous;

                        return;
                    }

                    $current = null;

                    return;
                }            

                throw new Exception("Cannot remove the head node");
            }

           /**            
            * Get the next node of nodes in the collection.
            *            
            * @return mixed
            */
            public function toNext()
            {
                if($this->next === null) {
                    
                    throw new Exception("The next node seems like doesn't exist");

                    return;
                }

                return $this->next;                
            }

           /**            
            * Get the previous node of nodes in the collection.
            *            
            * @return mixed
            */
            public function toPrevious()
            {
                if($this->previous === null) {
                    
                    throw new Exception("The previous node seems like doesn't exist");

                    return;
                }

                return $this->previous;
            }
        };
    }

   /**
    * Adding an item to the collection.
    *
    * @param mixed $item
    * @return void
    */
    public function add($item) {

        if($this->head === null) {

            $this->head = $this->__material__($item);
            $this->foot = null;

            return;
        }

        $current = $this->head;

        while($current->next != null) {

            $current = $current->next;
        }

        $material = $this->__material__($item);    
        $material->previous = $current;

        $current->next = $material;
        
        $this->foot = null;
    }

   /**
    * Check whether item given exist or not.
    *
    * @param mixed $item
    * @return bool
    */
    public function contain($item) : bool
    {
        $current = $this->head;        

        while($current != null) {

            if($item == $current->item) {

                return true;
            }

            $current = $current->next;
        }

        return false;
    }

   /**
    * Combine given node to existed nodes.
    *
    * @param \Libraries\Materials\Node $material
    * @return void
    */
    public function combine(Node $material)
    {
        $current = $material;

        while($current != null) {
        
            $this->add($current->item);

            $current = $current->next;
        }
    }

   /**
    * Count the number of items of the collection.
    *
    * @return int
    */
    public function count() : int
    {
        $length = 0;
        $current = $this->head;        

        while($current != null) {

            $length++;

            $current = $current->next;        
        }

        return $length;
    }

   /**
    * Give an action to each nodes in the collection.
    *
    * @param \Closure $callback
    * @return void
    */
    public function each(\Closure $callback)
    {
        $current = $this->head;

        while($current != null) {

            $callback($current);

            $current = $current->next;
        }
    }

   /**
    * Get RAW of the node instance.
    *
    * @return \Libraries\Materials\Node
    */
    public function getIterator() : Node
    {
        return $this->head;
    }

   /**
    * Determine if the collection is empty or not.
    *
    * @return bool
    */
    public function isEmpty() : bool
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
    public function isNotEmpty() : bool
    {    
        return !$this->isEmpty();
    }

   /**
    * Show all of items in the collection.
    *
    * @return void
    */
    public function print()
    {
        $current = $this->head;        

        while($current != null) {

            print($current->item . "\n");

            $current = $current->next;
        }        
    }

   /**
    * Clear nodes in the list collection.
    *
    * @return void
    */
    public function reset()
    {
        $this->head = null;
    }
}

