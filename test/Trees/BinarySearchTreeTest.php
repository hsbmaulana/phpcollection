<?php

declare(strict_types=1);

use Trees\BinarySearchTree;
use PHPUnit\Framework\TestCase;

class BinarySearchTreeTest extends TestCase
{
   /**
    * @var Trees\BinarySearchTree|null
    */
    protected ?BinarySearchTree $collection;

    /**
     * @return void
     */
    protected function setUp() : void
    {
        $this->collection = new BinarySearchTree();

        $this->collection->add(10);
        $this->collection->add(20);
        $this->collection->add(30);
        $this->collection->add(40);
        $this->collection->add(50);
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
    public function testAdd() : void
    {
        // $this->collection->breadth(); //
        // $this->collection->depth(); //

        $this->assertTrue(true);
    }

    /**
     * @return void
     * @group Unit
     */
    public function testContain() : void
    {
        $this->assertTrue($this->collection->contain(30));
    }
}