<?php

declare(strict_types=1);

namespace Lists\Contracts;

interface IList
{
   /**
    * @param int|string $value
    *
    * @return void
    */
    public function add(int|string $value) : void;

   /**
    * @return int
    */
    public function count() : int;

   /**
    * @param int $index
    *
    * @return int|string|null
    */
    public function get(int $index) : int|string|null;

   /**
    * @return \Lists\Contracts\Iterateable
    */
    public function iterate() : Iterateable;

   /**
    * @param int $index
    * @param int|string $value
    *
    * @return void
    */
    public function modify(int $index, int|string $value) : void;

   /**
    * @param int $index
    *
    * @return void
    */
    public function remove(int $index) : void;
}