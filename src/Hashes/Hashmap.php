<?php

declare(strict_types=1);

namespace Collections\Hashes;

use \Exception;
use \Libraries\Materials\Node;
use \Libraries\Materials\Hashnode;
use \Collections\Lists\ArrayList;
use \Collections\Lists\LinkedList;

class Hashmap
{
   /**
    * The hashtable to gathering nodes in the collection.
    *
    * @var array
    */
    private $bucket = array();

   /**
    * Quota of the bucket collection.
    *
    * @var int
    */
    private $capacity = 10;

   /**
    * Length of the nodes in the collection.
    * 
    * @var int
    */
    private $length = 0;

   /**
    * The names of mapped key.
    *
    * @var \Collections\Lists\ArrayList
    */
    private $map;

   /**
    * Create a new hash collection.
    *
    * @param int $quota
    * @return void
    */
    public function __construct(int $quota = 10)
    {
        $this->capacity = $quota;
        $this->map = new ArrayList();
    }

   /**
    * The hashfunction to encrypt-decrypt an object.
    *
    * @param mixed $object
    * @return int
    */
    private function chop($object) : int
    {
        $key = str_split((string) $object);
        $tablelength = $this->capacity;
        $character = 0;
        $hashed = 0;

        foreach($key as $value) {

            $character += ord($value);
        }

        $hashed = $character % $tablelength;

        return $hashed;
    }

   /**
    * Check whether key given exist or not.
    *
    * @param mixed $key
    * @return bool
    */
    public function contain($key) : bool
    {
        $found = false;

        $this->map->each(function($item) use ($key, &$found) {

            if($item == $key) { $found = true; return; }
        });

        return $found;
    }

   /**
    * The hashcode to put node to the bucket.
    *
    * @param \Libraries\Materials\Hashnode $node
    * @return void
    */
    private function crypt(Hashnode $node)
    {
        $index = $this->chop($node->key);        

        if(!isset($this->bucket[ $index ])) {

            $this->bucket[ $index ] = $node;

            $this->map->add($node->key);

            return;
        }

        $list = new LinkedList($this->bucket[ $index ]);
        $list->add($node);        

        $this->bucket[ $index ] = $list->getIterator();

        $this->map->add($node->key);
    }

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
    * Dump list of the collection.
    *
    * @return void
    */
    public function dump()
    {
        var_dump($this->bucket);
    }

   /**
    * Give an action to each items in the collection.
    *
    * @param \Closure $callback
    * @return void
    */
    public function each(\Closure $callback)
    {
        $this->map->each(function($key) use ($callback) {

            $callback($this->get($key));
        });
    }

   /**
    * Get the item with defined key.
    *
    * @return mixed $key
    * @return mixed
    */
    public function get($key)
    {
        $index = $this->chop($key);

        if(isset($this->bucket[ $index ])) {

            if( $this->bucket[ $index ] instanceof Hashnode ) {

                if( $this->bucket[$index]->key === $key ) return $this->bucket[ $index ]->item;

                return null;
            }

            $node = $this->bucket[ $index ];

            while($node != null) {

                if($node->item->key === $key) return $node->item->item;

                $node = $node->next;
            }
        }

        return null;
    }

   /**
    * Get keys in the collection.
    *
    * @return array
    */
    public function getKeys()
    {
        return $this->map->getAll();
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
    * Put an item with defined a key to the collection.
    *
    * @param mixed $key
    * @param mixed $item
    * @return void
    */
    public function put($key, $item)
    {
        if($this->contain($key)) {

            $this->remove($key);
            $this->put($key, $item);

            return;
        } else {

            if($this->chop($key) >= $this->capacity) {

                throw new Exception("The capacity of bucket nearly full");

                return;
            } else {

                $this->crypt(new Hashnode($key, $item));

                $this->length++;
            }
        }     
    }

   /**
    * Remove an item in the collection by given key.
    * 
    * @param mixed $key
    * @return void
    */
    public function remove($key)
    {
        if($this->contain($key)) {

            $index = $this->chop($key);
            $indexmap = $this->map->search()->byLinier($key);

            if($this->bucket[ $index ] instanceof Hashnode) {

                unset($this->bucket[ $index ]);
            } else {            

                $current = $this->bucket[ $index ];

                while($current != null) {

                    if($current->item->key === $key) {

                        try {
                            
                            $current->remove();

                        } catch(Exception $error) {                                                
                            
                            $this->bucket[ $index ] = $current->next;
                            $this->bucket[ $index ]->previous = null;
                        }

                        break;
                    }

                    $current = $current->next;
                }
            }

            if( isset($this->bucket[ $index ])
                &&
                $this->bucket[ $index ] instanceof Node
                &&
                $this->bucket[ $index ]->next === null ) {

                $hashnode = $this->bucket[ $index ]->item;
                $this->bucket[ $index ] = $hashnode;                
            }

            $this->map->remove($indexmap);
            $this->length--;
        }
    }

   /**
    * Clear items in the list collection.
    *
    * @return void
    */
    public function reset()
    {
        $this->map->reset();

        $this->bucket = null;
        $this->bucket = array();
        $this->length = 0;
    }
}

