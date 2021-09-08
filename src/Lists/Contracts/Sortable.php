<?php

declare(strict_types=1);

namespace Lists\Contracts;

interface Sortable
{
   /**
    * @return void
    */
    public function sort() : void;
}