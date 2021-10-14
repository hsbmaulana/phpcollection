<?php

declare(strict_types=1);

namespace Trees\Contracts;

interface ITree
{
   /**
    * @param int $value
    *
    * @return void
    */
    public function add(int $value) : void;

   /**
    * @param int $value
    *
    * @return bool
    */
    public function contain(int $value) : bool;

   /**
    * @return void
    */
    public function breadth() : void;

   /**
    * @return void
    */
    public function depth() : void;
}