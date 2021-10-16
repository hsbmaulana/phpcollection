<?php

declare(strict_types=1);

use Graphs\UndirectedGraph;
use PHPUnit\Framework\TestCase;

class UndirectedGraphTest extends TestCase
{
   /**
    * @var Graphs\UndirectedGraph|null
    */
    protected ?UndirectedGraph $collection;

   /**
    * @return void
    */
    protected function setUp() : void
    {
        $this->collection = new UndirectedGraph(5);

        $this->collection->push("A");
        $this->collection->enqueue("B");
        $this->collection->push("C");
        $this->collection->enqueue("D");
        $this->collection->push("E");

        $this->collection->addEdge(0, 1, 10);
        $this->collection->addEdge(1, 2, 20);
        $this->collection->addEdge(2, 3, 30);
        $this->collection->addEdge(4, 1, 40);
        $this->collection->addEdge(3, 2, 50);
    }

   /**
    * @return void
    */
    protected function tearDown() : void
    {
        $this->collection = null;
    }

   /**
    * @return void
    * @group Unit
    */
    public function testVertex() : void
    {
        $this->assertSame($this->collection->vertices, ["D", "B", "A", "C", "E"]);
    }

   /**
    * @return void
    * @group Unit
    */
    public function testEdge() : void
    {
        $this->assertSame($this->collection->edges,
        [
            [
                0, 10, 0, 0, 0
            ],
            [
                10, 0, 20, 0, 40
            ],
            [
                0, 20, 0, 50, 0
            ],
            [
                0, 0, 50, 0, 0
            ],
            [
                0, 40, 0, 0, 0
            ]
        ]);
    }

   /**
    * @return void
    * @group Unit
    */
    public function testTraverse() : void
    {
        // $this->collection->breadth(3); //
        // $this->collection->depth(3); //

        $this->assertTrue(true);
    }
}