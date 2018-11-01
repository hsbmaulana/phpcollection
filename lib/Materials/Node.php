<?php

declare(strict_types=1);

namespace Libraries\Materials;

use \Exception;

class Node
{
   /**
    * Item of the current node.
    *
    * @var mixed
    */
    public $item = null;

   /**
    * The next node.
    *
    * @var \Libraries\Materials\Node
    */
    public $next = null;

   /**
    * The previous node.
    *
    * @var \Libraries\Materials\Node
    */
    public $previous = null;

   /**
    * Create current node also set the current item.
    *
    * @param mixed $item
    * @return void
    */
    public function __construct($item)
    {
        $this->item = $item;
    }
}

