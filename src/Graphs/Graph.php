<?php

declare(strict_types=1);

namespace Collections\Graphs;

use \Exception;
use \Libraries\Materials\Vertex;
use \Collections\Hashes\Hashmap;
use \Collections\Stacks\LinkedList as Stack;
use \Collections\Queues\LinkedList as Queue;

class Graph
{
   /**
    * The capacity of vertex in the collection.
    *
    * @var int
    */
    private $capacity = 0;

   /**
    * Representer matrix of edges.
    *
    * @var array
    */
    private $matrix = array();

   /**
    * Container of vertices.
    *
    * @var array
    */
    private $vertex = array();

   /**
    * Create a new graph collection.
    *
    * @param int $capacity
    * @return void
    */
    public function __construct(int $capacity)
    {
        if($capacity < 1) {

            throw new Exception("The capacity that you given must be more than one");

            return;
        }

        $this->capacity = $capacity;
        $this->reset();
    }

   /**
    * Adding a connection edge between vertices in the collection.
    *
    * @param string $start
    * @param string $end
    * @param int $weight
    * @return void
    */
    public function addEdge(string $start, string $end, int $weight = 1)
    {
        $i = $this->indexOf($start);
        $j = $this->indexOf($end);

        $this->matrix[$i][$j] = $weight;
        $this->matrix[$j][$i] = $weight;
    }

   /**
    * Adding a vertex to the collection.
    *
    * @param string $label
    * @return void
    */
    public function addVertex(string $label)
    {
        $iterator = $this->count();

        if($iterator < $this->capacity) {

            foreach($this->vertex as $node) {

                if($node->label == $label)

                throw new Exception("Label does exist try another name");                
            }

            $this->vertex[$iterator] = new Vertex($label);        
        }
    }

   /**
    * Get the length of existed vertices in the collection.
    *
    * @return int
    */
    public function count() : int
    {
        return count($this->vertex);
    }

   /**
    * Show vertex with the defined index in the collection.
    *
    * @param int $index
    * @return void
    */
    protected function displayVertex(int $index)
    {
        $label = $this->vertex[ $index ]->label;

        print($label . "\n");
    }

   /**
    * Dump matrix of graph in the collection.
    *
    * @return void
    */
    public function dump()
    {
        $this->export()->dump();
    }

   /**
    * Export the vertices and its relationships.
    *
    * @return \Collections\Hashes\Hashmap
    */
    public function export() : Hashmap
    {
        $map = new Hashmap($this->capacity);

        for($i = 0; $i < $this->count(); $i++) {

            $label = $this->vertex[$i]->label;
            $related = $this->fetch($i);

            if($label === '') {

                continue;
            }

            $value = array();

            foreach($related->getKeys() as $key) {

                array_push($value, array( $key, $related->get($key) ));
            }

            $map->put($label, $value);
        }

        $map->put('$', $this->capacity);

        return $map;
    }

   /**
    * Get the adjacency edge of vertex that connected to vertices.
    *
    * @param int $index
    * @return \Collections\Hashes\Hashmap
    */
    protected function fetch(int $index) : Hashmap
    {
        $map = new Hashmap($this->capacity);

        for($j = 0; $j < $this->capacity; $j++) {

            if($this->matrix[$index][$j] != 0) {

                $map->put($this->vertex[$j]->label, $this->matrix[$index][$j]);
            }
        }

        return $map;
    }

   /**
    * Get the adjacency unvisited vertex.
    *
    * @param int $index
    * @return int
    */
    private function getUnvisited(int $index) : int
    {
        for($j = 0; $j < $this->count(); $j++) {

            if($this->matrix[$index][$j] != 0 && $this->vertex[$j]->visited == false)

            return $j;
        }

        return -1;        
    }

   /**
    * Import the vertices and its relationships.
    *
    * @param \Collections\Hashes\Hashmap $map
    * @return void
    */
    public function import(Hashmap $map)
    {
        $this->vertex = array();

        $this->capacity = $map->get('$') + $map->get('$');
        $this->reset();

        $map->remove('$');

        foreach($map->getKeys() as $key) $this->addVertex($key);

        for($i = 0; $i < $this->count(); $i++) {

            $label = $this->vertex[$i]->label;

            $relates = $map->get($label);

            foreach($relates as $relate) {

                $this->addEdge($label, $relate[0], $relate[1]);
            }
        }
    }

   /**
    * Get the index number of vertex by given label.
    *
    * @param string $label
    * @return int
    */
    protected function indexOf(string $label) : int
    {
        foreach($this->vertex as $index => $node) {

            if($node->label === $label) return $index;
        }

        throw new Exception("The given label doesn't exist");
        return -1;        
    }

   /**
    * Check whether vertex is connected to another vertex or not in the collection.
    *
    * @param string $start
    * @param string $end    
    * @return bool
    */
    public function isEdge(string $start, string $end) : bool
    {
        $i = $this->indexOf($start);
        $j = $this->indexOf($end);

        return $this->matrix[$i][$j] != 0;
    }

   /**
    * Show all of labels that have connection with breadth first search algorithm.
    *
    * @return void
    */
    public function pbfs()
    {
        $queue = new Queue();

        $this->vertex[0]->visited = true;
        $this->displayVertex(0);
        $queue->enqueue(0);

        while($queue->isNotEmpty()) {
        
            $temporary = $queue->pool();

            while(($unvisited = $this->getUnvisited($temporary)) != -1) {

                $this->vertex[$unvisited]->visited = true;
                $this->displayVertex($unvisited);
                $queue->enqueue($unvisited);
            }
        }

        $this->setUnvisited();
    }

   /**
    * Show all of labels that have connection with depth first search algorithm.
    *
    * @return void
    */
    public function pdfs()
    {
        $stack = new Stack();
        
        $this->vertex[0]->visited = true;
        $this->displayVertex(0);
        $stack->push(0);

        while($stack->isNotEmpty()) {

            $unvisited = $this->getUnvisited($stack->peek());

            if($unvisited == -1) {

                $stack->pop();

            } else {

                $this->vertex[$unvisited]->visited = true;
                $this->displayVertex($unvisited);
                $stack->push($unvisited);
            }
        }

        $this->setUnvisited();
    }

   /**
    * Remove a connection edge between vertices in the collection.
    *
    * @param string $start
    * @param string $end
    * @return void
    */
    public function removeEdge(string $start, string $end)
    {
        $i = $this->indexOf($start);
        $j = $this->indexOf($end);

        $this->matrix[$i][$j] = 0;
        $this->matrix[$j][$i] = 0;
    }

   /**
    * Remove a vertex in the collection.
    *
    * @param string $label
    * @return void
    */
    public function removeVertex(string $label)
    {        
        $index = $this->indexOf($label);
        $map = $this->fetch($index);

        if($index == 0) {

            throw new Exception("You cannot remove the first vertex");
            return;
        }

        foreach($map->getKeys() as $key) {            

            $this->removeEdge($label, $key);
        }

        $this->vertex[$index] = new Vertex('');
    }

   /**
    * Reset the adjacency edge of matrix in the collection.
    *
    * @return void
    */
    public function reset()
    {
        for($i = 0; $i < $this->capacity; $i++) {

            for($j = 0; $j < $this->capacity; $j++) {

                $this->matrix[$i][$j] = 0;
            }
        }
    }

   /**
    * Set the adjacency of vertices to unvisited.
    *
    * @return void
    */
    private function setUnvisited()
    {
        foreach($this->vertex as $node) {

            $node->visited = false;
        }    
    }
}

