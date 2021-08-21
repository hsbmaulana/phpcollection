<?php

declare(strict_types=1);

namespace Collections\Trees;

use \Exception;
use \Libraries\Materials\Tree;
use \Collections\Queues\LinkedList as Queue;

class BinaryTree extends Tree
{
   /**
    * Create a new tree collection.
    *
    * @param mixed $item
    * @return void
    */
    public function __construct($item = null)
    {
        parent::__construct($item);
    }

   /**
    * Get the left child.
    *
    * @return mixed
    */
    public function downLeft()
    {
        return $this->left;
    }

   /**
    * Get the right child.
    *
    * @return mixed
    */
    public function downRight()
    {
        return $this->right;
    }

   /**
    * Getter of the current item.
    *
    * @return mixed
    */
    public function getItem()
    {
        return $this->item;
    }

   /**
    * Insert item as new left node to the tree collection.
    *
    * @param mixed $item
    * @return void
    */
    public function insertLeftChild($item)
    {
        $this->left = new BinaryTree($item);
    }

   /**
    * Insert item as new right node to the tree collection.
    *
    * @param mixed $item
    * @return void
    */
    public function insertRightChild($item)
    {
        $this->right = new BinaryTree($item);
    }

   /**
    * Show all of nodes data with breadth first search algorithm.
    *
    * @return void
    */
    public function pbfs()
    {        
        $root = $this;
        $queue = new Queue();

        $queue->enqueue($root);

        while($queue->isNotEmpty()) {

            $temporary = $queue->pool();

            print($temporary->getItem() . "\n");        

            if($temporary->downLeft() != null) {

                $queue->enqueue($temporary->downLeft());
            }

            if($temporary->downRight() != null) {

                $queue->enqueue($temporary->downRight());
            }
        }
    }

   /**
    * Show all of nodes data with depth first search algorithm.
    *
    * @param string $sort
    * @return void
    */
    public function pdfs(string $sort)
    {
        switch($sort) {

            case "inorder" : $this->printDFSInOrder();
            break;

            case "preorder" : $this->printDFSPreOrder();
            break;

            case "postorder" : $this->printDFSPostOrder();
            break;
        }
    }

   /**
    * Show all of nodes as in ordering in the tree collection.
    *
    * @return void
    */
    protected function printDFSInOrder()
    {
        if($this->left != null) {

            $this->left->printDFSInOrder();
        }

        print($this->item . "\n");

        if($this->right != null) {

            $this->right->printDFSInOrder();
        }
    }

   /**
    * Show all of nodes as pre ordering in the tree collection.
    *
    * @return void
    */
    protected function printDFSPreOrder()
    {
        print($this->item . "\n");

        if($this->left != null) {

            $this->left->printDFSPreOrder();
        }    

        if($this->right != null) {

            $this->right->printDFSPreOrder();
        }
    }

   /**
    * Show all of nodes as post ordering in the tree collection.
    *
    * @return void
    */
    protected function printDFSPostOrder()
    {
        if($this->left != null) {

            $this->left->printDFSPostOrder();
        }    

        if($this->right != null) {

            $this->right->printDFSPostOrder();
        }

        print($this->item . "\n");
    }

   /**
    * Remove the left of child node in the collection.
    *
    * @return void
    */
    public function removeLeftChild()
    {
        if($this->left == null) {

            throw new Exception("The left child doesn't exist");            
        }

        $this->left = null;
    }

   /**
    * Remove the right of child node in the collection.
    *
    * @return void
    */
    public function removeRightChild()
    {
        if($this->right == null) {

            throw new Exception("The right child doesn't exist");    
        }

        $this->right = null;
    }

   /**
    * Setter of the current item.
    *
    * @param mixed $item
    * @return void
    */
    public function setItem($item)
    {
        $this->item = $item;
    }
}

