<?php

declare(strict_types=1);

namespace Libraries\Materials;

use \Exception;

class Hashnode
{
   /**
    * Item of the current node.
    *
    * @var mixed
    */
    public $item = null;

   /**
    * Define the identity.
    *
    * @var string
    */
    public $key = "";

   /**
    * Create current hashnode also set the current item.
    *
    * @param mixed $key
    * @param mixed $item
    * @return void
    */
    public function __construct($key, $item)
    {
        $this->key = $key;
        $this->item = $item;
    }
}

