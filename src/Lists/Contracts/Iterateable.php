<?php

declare(strict_types=1);

namespace Lists\Contracts;

interface Iterateable
{
   /**
    * @return bool
    */
    public function hasNext() : bool;

   /**
    * @return int|string|null
    */
    public function next() : int|string|null;
}