<?php

declare(strict_types=1);

namespace Lists;

use Error;
use Exception;
use Lists\Contracts\{IList, Iterateable, Sortable, Searchable};

class Node
{
   /**
    * @var Node|null
    */
    public ?Node $previous = null;

   /**
    * @var Node|null
    */
    public ?Node $next = null;

   /**
    * @var int|string $value
    */
    public int|string $value;

   /**
    * @param int|string $value
    *
    * @return void
    */
    public function __construct(int|string $value)
    {
        $this->value = $value;
    }

   /**
    * @return void
    */
    public function __destruct() {}
}

class LinkedList implements IList, Sortable, Searchable
{
   /**
    * @var int
    */
    private int $length = 0;

   /**
    * @var Node|null
    */
    public ?Node $head = null;

   /**
    * @var Node|null
    */
    public ?Node $foot = null;

   /**
    * @return void
    */
    public function __construct() {}

   /**
    * @return void
    */
    public function __destruct() {}

   /**
    * @param int|string $value
    *
    * @return void
    */
    public function add(int|string $value) : void
    {
        if ($this->head === null) {

            $this->head = new Node($value);
            $this->foot = $this->head;

            $this->length++;

        } else {

            $current = $this->head;

            while ($current->next) {

                $current = $current->next;
            }

            $current->next = new Node($value);
            $current->next->previous = $current;

            $this->foot = $current->next;
            $this->length++;
        }
    }

   /**
    * @return int
    */
    public function count() : int
    {
        return $this->length;
    }

   /**
    * @param int $index
    *
    * @return int|string|null
    */
    public function get(int $index) : int|string|null
    {
        if ($index >= 0 && $index < $this->count()) {

            for ($iterator = $this->iterate(), $i = 0; $iterator->hasNext(); $i++) {

                $value = $iterator->next(); if ($i === $index) return $value;
            }
        }

        return null;
    }

   /**
    * @return \Lists\Contracts\Iterateable
    */
    public function iterate() : Iterateable
    {
        return new class($this) implements Iterateable
        {
            /**
             * @var Node|null
             */
            public ?Node $iterator = null;

            /**
             * @var \Lists\Contracts\IList
             */
            private \Lists\Contracts\IList $state;

            /**
             * @param \Lists\Contracts\IList $state
             *
             * @return void
             */
            public function __construct(IList $state)
            {
                $this->state = $state;
                $this->iterator = $this->state->head;
            }

            /**
             * @return void
             */
            public function __destruct() {}

            /**
             * @return bool
             */
            public function hasNext() : bool
            {
                return $this->iterator !== null;
            }

            /**
             * @return int|string|null
             */
            public function next() : int|string|null
            {
                if ($this->hasNext()) {

                    $value = $this->iterator->value;
                    $this->iterator = $this->iterator->next;

                    return $value;
                }

                return null;
            }
        };
    }

   /**
    * @param int $index
    * @param int|string $value
    *
    * @return void
    */
    public function modify(int $index, int|string $value) : void
    {
        if ($index >= 0 && $index < $this->count()) {

            for ($iterator = $this->iterate(), $i = 0; $iterator->hasNext(); $i++) {

                $node = $iterator->iterator; if ($i === $index) { $node->value = $value; return; }

                $iterator->next(); 
            }
        }
    }

   /**
    * @param int $index
    *
    * @return void
    */
    public function remove(int $index) : void
    {
        if ($index >= 0 && $index < $this->count()) {

            for ($iterator = $this->iterate(), $i = 0; $iterator->hasNext(); $i++) {

                $node = &$iterator->iterator;

                if ($i === $index) {

                    if ($node->previous && $node->next) {

                        $node->previous->next = $node->next;
                        $node->next->previous = $node->previous;

                    } else if ($node->previous && $node->next === null) {

                        $node->previous->next = null;
                        $this->foot = $node->previous;

                    } else if ($node->previous === null && $node->next) {

                        $node->next->previous = null;
                        $this->head = $node->next;

                    } else if ($node->previous === null && $node->next === null) {

                        $node = null;
                        $this->head = $node;
                        $this->foot = $node;
                    }

                    $this->length--;

                    return;
                }

                $iterator->next();
            }
        }
    }

   /**
    * @return void
    */
    public function sort() : void {}

   /**
    * @return int|string|null
    */
    public function search() : int|string|null {}
}