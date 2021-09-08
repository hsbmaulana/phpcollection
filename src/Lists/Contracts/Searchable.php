<?php

declare(strict_types=1);

namespace Lists\Contracts;

interface Searchable
{
   /**
    * @return int|string|null
    */
    public function search() : int|string|null;
}