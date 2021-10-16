<?php

declare(strict_types=1);

namespace Graphs\Contracts;

interface IGraph
{
   /**
    * @param int|string $value
    *
    * @return void
    */
    public function push(int|string $value) : void;

   /**
    * @return void
    */
    public function pop() : void;

   /**
    * @param int|string $value
    *
    * @return void
    */
    public function enqueue(int|string $value) : void;

   /**
    * @return void
    */
    public function dequeue() : void;

   /**
    * @param int $row
    * @param int $column
    * @param int $weight
    *
    * @return void
    */
    public function addEdge(int $row, int $column, int $weight) : void;

   /**
    * @param int $row
    * @param int $column
    *
    * @return void
    */
    public function removeEdge(int $row, int $column) : void;

   /**
    * @param int $edged
    *
    * @return void
    */
    public function breadth(int $edged) : void;

   /**
    * @param int $edged
    *
    * @return void
    */
    public function depth(int $edged) : void;
}