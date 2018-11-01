<?php

declare(strict_types=1);

namespace Libraries\Materials;

use \Exception;

class Vertex
{
   /**
    * Item of the current node.
    *
    * @var mixed
    */
    public $item = null;

   /**
    * Determine if the vertex has visited or not.
    *
    * @var bool
    */
    public $visited = false;

   /**
    * Create vertex node also set the current item.
    *
    * @param mixed $item
    * @return void
    */
    public function __construct($item)
    {
        $this->item = $item;
    }
}

