<?php

declare(strict_types=1);

namespace Collections\Hashes;

use \Exception;

class Hashset
{
   /**
    * The hashtable to gathering elements in the collection.
    *
    * @var \Collections\Hashes\Hashmap
    */
    private $map;

   /**
    * The constant object of values in the collection.
    *
    * @var \StdClass
    */
    private $object;

   /**
    * Create a new hash collection.
    *
    * @param int $quota
    * @return void
    */
    public function __construct(int $quota = 10)
    {
        $this->object = new \StdClass();
        $this->map = new Hashmap($quota);    
    }

   /**
    * Add element(s) to the collection.
    *
    * @param mixed $element
    * @return void
    */
    public function add($element)
    {
        if(is_object($element) && $element instanceof Hashset) {

            $element->each(function($key) {

                if($this->contain($key)) return;

                $this->add($key);
            });

            return;
        }

        $this->map->put($element, $this->object);
    }

   /**
    * Check whether element given exist or not.
    *
    * @param mixed $key
    * @return bool
    */
    public function contain($key) : bool
    {
        return $this->map->contain($key);
    }

   /**
    * Count the number of elements of the collection.
    *
    * @return int
    */
    public function count() : int
    {
        return $this->map->count();
    }

   /**
    * Give an action to each elements in the collection.
    *
    * @param \Closure $callback
    * @return void
    */
    public function each(\Closure $callback)
    {
        foreach($this->map->getKeys() as $key) {

            $callback($key);
        }
    }

   /**
    * Determine if the collection is empty or not.
    *
    * @return bool
    */
    public function isEmpty() : bool
    {
        return $this->map->isEmpty();
    }

   /**
    * Determine if the collection is not empty.
    *
    * @return bool
    */
    public function isNotEmpty() : bool
    {
        return $this->map->isNotEmpty();
    }

   /**
    * Show all of elements in the collection.
    *
    * @return void
    */
    public function print()
    {
        $output = "";

        $this->each(function($item) use (&$output) {

            $output .= " " . $item  . " ";
        });

        print "\n"; print "{" . $output . "}"; print "\n";
    }

   /**
    * Remove element(s) in the collection by given element.
    * 
    * @param mixed $element
    * @return void
    */
    public function remove($element)
    {
        if(is_object($element) && $element instanceof Hashset) {

            $element->each(function($key) {

                $this->remove($key);
            });

            return;
        }

        $this->map->remove($element);
    }

   /**
    * Clear elements in the list collection.
    *
    * @return void
    */
    public function reset()
    {
        $this->map->reset();
    }
}

