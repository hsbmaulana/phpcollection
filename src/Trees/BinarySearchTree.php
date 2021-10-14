<?php

declare(strict_types=1);

namespace Trees;

use Error;
use Exception;
use Trees\Contracts\ITree;

class BinarySearchTree implements ITree
{
   /**
    * @var \Trees\BinarySearchTree|null
    */
    public ?BinarySearchTree $left = null;

   /**
    * @var \Trees\BinarySearchTree|null
    */
    public ?BinarySearchTree $right = null;

   /**
    * @var int|null $value
    */
    public ?int $value = null;

   /**
    * @param int $value
    *
    * @return void
    */
    public function add(int $value) : void
    {
        if (! $this->value) {

            $this->value = $value;

            return;
        }

        if ($value > $this->value) {

            if ($this->right) {

                $this->right->add($value);

            } else {

                $this->right = new BinarySearchTree();
                $this->right->add($value);
            }

        } else {

            if ($this->left) {

                $this->left->add($value);

            } else {

                $this->left = new BinarySearchTree();
                $this->left->add($value);
            }
        }
    }

   /**
    * @param int $value
    *
    * @return bool
    */
    public function contain(int $value) : bool
    {
        if ($value === $this->value) {

            return true;
        }

        if ($value > $this->value) {

            if ($this->right) {

                return $this->right->contain($value);

            } else {

                return false;
            }

        } else {

            if ($this->left) {

                return $this->left->contain($value);

            } else {

                return false;
            }
        }
    }

   /**
    * @return void
    */
    public function breadth() : void
    {
        for ($queue = [ $this, ]; count($queue) > 0;) {

            $front = array_shift($queue);
            $rear;

            fwrite(STDOUT, $front->value . "\n");

            if ($front->left) {

                array_push($queue, $front->left);
            }

            if ($front->right) {

                array_push($queue, $front->right);
            }
        }
    }

   /**
    * @return void
    */
    public function depth() : void
    {
        if ($this->left) {

            $this->left->depth();
        }

        fwrite(STDOUT, $this->value . "\n");

        if ($this->right) {

            $this->right->depth();
        }
    }
}