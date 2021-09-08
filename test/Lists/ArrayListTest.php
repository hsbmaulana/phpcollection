<?php

declare(strict_types=1);

use Lists\ArrayList;
use PHPUnit\Framework\TestCase;

class ArrayListTest extends TestCase
{
   /**
    * @var Lists\ArrayList|null
    */
    protected ?ArrayList $collection;

    /**
     * @return void
     */
    protected function setUp() : void
    {
        $this->collection = new ArrayList();

        $this->collection->add("A");
        $this->collection->add("B");
        $this->collection->add("C");
        $this->collection->add("D");
        $this->collection->add("E");
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
        for ($iterator = $this->collection->iterate(); $iterator->hasNext();) {

            $this->assertContains($iterator->next(), ["A", "B", "C", "D", "E"]);
        }
    }

    /**
     * @return void
     * @group Unit
     */
    public function testCount() : void
    {
        $this->assertEquals($this->collection->count(), 5);
    }

    /**
     * @return void
     * @group Unit
     */
    public function testGet() : void
    {
        $this->assertEquals($this->collection->get(4), "E");
    }

    /**
     * @return void
     * @group Unit
     */
    public function testModify() : void
    {
        $this->collection->modify(4, "XYZ");

        $this->assertNotEquals($this->collection->get(4), "E");
    }

    /**
     * @return void
     * @group Unit
     */
    public function testRemove() : void
    {
        $this->collection->remove(4);
        $this->assertNotEquals($this->collection->get(4), "E");

        $this->collection->remove(3);
        $this->assertNotEquals($this->collection->get(3), "D");

        $this->collection->remove(2);
        $this->assertNotEquals($this->collection->get(2), "C");

        $this->collection->remove(1);
        $this->assertNotEquals($this->collection->get(1), "B");

        $this->collection->remove(0);
        $this->assertNotEquals($this->collection->get(0), "A");

        $this->assertEquals($this->collection->count(), 0);
    }
}