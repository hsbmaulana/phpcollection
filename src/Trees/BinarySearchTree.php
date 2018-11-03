<?php

declare(strict_types=1);

namespace Collections\Trees;

use \Exception;

class BinarySearchTree extends BinaryTree
{
   /**
    * Create a new tree collection.
    *
    * @param int $value
    * @return void
    */
    public function __construct(int $value = 0)
    {
        parent::__construct($value);
    }

   /**
    * Check whether value given exist or not.
    *
    * @param int $value
    * @return bool
    */
    public function contain(int $value) : bool
    {
        if($value == $this->item) {

            return true;
        }

        if($value < $this->item) {

            if($this->left == null) {

                return false;
            } else {

                return $this->left->contain($value);
            }
        } else {

            if($this->right == null) {

                return false;
            } else {

                return $this->right->contain($value);
            }
        }
    }

   /**
    * Insert value as new node to the tree collection.
    *
    * @param int $value
    * @return void
    */
    public function insert(int $value)
    {
        if($value <= $this->item) {

            if($this->left == null) {

                $this->left = new BinarySearchTree($value);
            } else {
                
                $this->left->insert($value);
            }
        } else {

            if($this->right == null) {

                $this->right = new BinarySearchTree($value);
            } else {

                $this->right->insert($value);
            }
        }
    }
}

