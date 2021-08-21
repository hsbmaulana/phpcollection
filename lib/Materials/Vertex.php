<?php

declare(strict_types=1);

namespace Libraries\Materials;

use \Exception;

class Vertex
{
   /**
    * Label of the current node.
    *
    * @var string
    */
    public $label = "";

   /**
    * Determine if the vertex has visited or not.
    *
    * @var bool
    */
    public $visited = false;

   /**
    * Create vertex node also set the label name.
    *
    * @param string $label
    * @return void
    */
    public function __construct(string $label)
    {
        $this->label = $label;
    }
}
