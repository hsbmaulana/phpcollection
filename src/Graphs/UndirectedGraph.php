<?php

declare(strict_types=1);

namespace Graphs;

use Error;
use Exception;

class UndirectedGraph extends Graph
{
   /**
    * @param int $row
    * @param int $column
    * @param int $weight
    *
    * @return void
    */
    public function addEdge(int $row, int $column, int $weight) : void
    {
        $this->edges[$row][$column] = $weight;
        $this->edges[$column][$row] = $weight;
    }

   /**
    * @param int $row
    * @param int $column
    *
    * @return void
    */
    public function removeEdge(int $row, int $column) : void
    {
        $this->edges[$row][$column] = 0;
        $this->edges[$column][$row] = 0;
    }
}