<?php

declare(strict_types=1);

namespace Lists;

use Error;
use Exception;
use SplFixedArray;
use Lists\Contracts\{IList, Iterateable, Sortable, Searchable};

class ArrayList implements IList, Sortable, Searchable
{
   /**
    * @var int
    */
    private int $index = 0;

   /**
    * @var int
    */
    private int $capacity = 10;

   /**
    * @var \SplFixedArray
    */
    private SplFixedArray $list;

   /**
    * @return void
    */
    public function __construct()
    {
        $this->list = new SplFixedArray($this->capacity);
    }

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
        if ($this->count() == $this->capacity) {

            $capacity  = $this->capacity * 2;
            $temporary = new SplFixedArray($capacity);

            for ($i = 0; $i < $this->capacity; $i++) {

                $temporary[$i] = $this->list[$i];
            }

            $this->capacity = $capacity;
            $this->list = $temporary;
        }

        $this->list[$this->index++] = $value;
    }

   /**
    * @return int
    */
    public function count() : int
    {
        return $this->index;
    }

   /**
    * @param int $index
    *
    * @return int|string|null
    */
    public function get(int $index) : int|string|null
    {
        if ($index >= 0 && $index < $this->count()) {

            return $this->list[$index];
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
             * @var int
             */
            public int $iterator = 0;

            /**
             * @var \Lists\Contracts\IList
             */
            private IList $state;

            /**
             * @param \Lists\Contracts\IList $state
             *
             * @return void
             */
            public function __construct(IList $state)
            {
                $this->state = $state;
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
                return $this->iterator < $this->state->count();
            }

            /**
             * @return int|string|null
             */
            public function next() : int|string|null
            {
                if ($this->hasNext()) {

                    return $this->state->get($this->iterator++);
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

            $this->list[$index] = $value;
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

            for (; $this->list->offsetExists($index + 1) != null; $index++) {

                $this->list[$index] = $this->list[$index + 1];
            }

            unset($this->list[--$this->index]);
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