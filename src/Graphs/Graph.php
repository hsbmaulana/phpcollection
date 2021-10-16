<?php

declare(strict_types=1);

namespace Graphs;

use Error;
use Exception;
use Graphs\Contracts\IGraph;

abstract class Graph implements IGraph
{
   /**
    * @var array
    */
    public array $vertices = [];

   /**
    * @var array
    */
    public array $edges = [[]];

   /**
    * @param int $capacity
    *
    * @return void
    */
    public function __construct(int $capacity = 10)
    {
        for ($i = 0; $i < $capacity; $i++) {

            $this->edges[$i] = [];

            for ($j = 0; $j < $capacity; $j++) {

                $this->edges[$i][$j] = 0;
            }
        }
    }

   /**
    * @return void
    */
    public function __destruct() {}

   /**
    * @param int|string $value
    *
    * @return void
    */
    public function push(int|string $value) : void
    {
        array_push($this->vertices, $value);
    }

   /**
    * @return void
    */
    public function pop() : void
    {
        for ($i = 0, $last = count($this->vertices) - 1; $i <= $last; $i++) {

            $this->removeEdge($last, $i);
        }

        array_pop($this->vertices);
    }

   /**
    * @param int|string $value
    *
    * @return void
    */
    public function enqueue(int|string $value) : void
    {
        array_unshift($this->vertices, $value);
    }

   /**
    * @return void
    */
    public function dequeue() : void
    {
        for ($i = 0, $first = 0, $last = count($this->vertices) - 1; $i <= $last; $i++) {

            $this->removeEdge($first, $i);
        }

        array_shift($this->vertices);
    }

   /**
    * @param int $row
    * @param int $column
    * @param int $weight
    *
    * @return void
    */
    abstract public function addEdge(int $row, int $column, int $weight) : void;

   /**
    * @param int $row
    * @param int $column
    *
    * @return void
    */
    abstract public function removeEdge(int $row, int $column) : void;

   /**
    * @param int $edged
    *
    * @return void
    */
    public function breadth(int $edged) : void
    {
        for ($queue = [ $edged, ], $log = []; count($queue) > 0;) {

            $front = array_shift($queue);
            $rear;
            array_push($log, $front);

            fwrite(STDOUT, $this->vertices[$front] . "\n");

            for ($i = 0; $i < count($this->vertices); $i++) {

                if ($this->edges[$front][$i] !== 0 && !in_array($i, $log)) array_push($queue, $i);
            }
        }
    }

   /**
    * @param int $edged
    *
    * @return void
    */
    public function depth(int $edged) : void
    {
        $GLOBALS['log'] = []; $GLOBALS['reference'] = $this;

        function recurse($i)
        {
            array_push($GLOBALS['log'], $i);

            for ($j = 0; $j < count($GLOBALS['reference']->vertices); $j++) {

                if ($GLOBALS['reference']->edges[$i][$j] !== 0 && !in_array($j, $GLOBALS['log'])) recurse($j);
            }

            fwrite(STDOUT, $GLOBALS['reference']->vertices[$i] . "\n");
        }

        recurse($edged);
    }
}