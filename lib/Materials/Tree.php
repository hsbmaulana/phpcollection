<?php

declare(strict_types=1);

namespace Libraries\Materials;

use \Exception;

class Tree
{
   /**
    * Item of the current node.
    *
    * @var mixed
    */
    public $item = null;

   /**
    * The left child node.
    *
    * @var \Libraries\Materials\Tree
    */
    public $left = null;

   /**
    * The right child node.
    *
    * @var \Libraries\Materials\Tree
    */
    public $right = null;

   /**
    * Create current node tree also set the current item.
    *
    * @param mixed $item
    * @return void
    */
    public function __construct($item)
    {
        $this->item = $item;
    }
}

