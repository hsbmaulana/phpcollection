<?php

declare(strict_types=1);

namespace Libraries\Algorithms;

use \Exception;

class ArraySearch
{
   /**
    * The sorted items list to search.
    *
    * @var array
    */
    private $items = array();

   /**
    * Create an item as list.
    *
    * @param array $items
    * @return void
    */
    public function __construct(array $items)
    {        
        $this->items = $items;
    }

   /**
    * Find a value from sorted items by binary search algorithm.
    *
    * @param int $value
    * @return int
    */
    public function byBinary(int $value) : int
    {
        $result = -1;
        $l = 0;
        $r = count($this->items) - 1;

        try {

            $this->verify();

        } catch(Exception $e) {

            error_log($e->getMessage());
        }

        for( ; $l <= $r ; ) {

            $m = (integer) (($l + $r) / 2);

            if($value == $this->items[$m]) {

                $result = $m;
                break;
            } else if($value < $this->items[$m]) {

                $r = $m - 1;
            } else if($value > $this->items[$m]) {

                $l = $m + 1;
            }
        }

        return (int) $result;
    }
 
   /**
    * Find a value from sorted items by interpolation search algorithm.
    *
    * @param int $value
    * @return int
    */
    public function byInterpolation(int $value) : int
    {
        $result = -1;
        $l = 0;
        $r = count($this->items) - 1;

        try {

            $this->verify();

        } catch(Exception $e) {

            error_log($e->getMessage());
        }

        for( ; $l <= $r &&
               $value >= $this->items[$l] &&
               $value <= $this->items[$r] ; ) {

            $pos = (integer)
                   $l + (
                   (($value - $this->items[$l]) * ($r - $l))
                   /
                   ($this->items[$r] - $this->items[$l])
                   );

            if($value == $this->items[$pos]) {

                $result = $pos;
                break;
            } else if($value < $this->items[$pos]) {

                $r = $pos - 1;
            } else if($value > $this->items[$pos]) {

                $l = $pos + 1;
            }
        }

        return (int) $result;
    }

   /**
    * Find a value from sorted items by jump search algorithm.
    *
    * @param int $value
    * @return int
    */
    public function byJump(int $value) : int
    {
        $length = count($this->items);
        $sqroot = sqrt($length);
        $result = -1;

        if($length % $sqroot != 0) {

            throw new Exception("Range of items doesn't have square root");

            return -1;

        } else if($value > $this->items[$length - 1]) {

            return $result;
        }

        try {

            $this->verify();

        } catch(Exception $e) {

            error_log($e->getMessage());
        }

        for($i = 0; $i < $length; $i = $i + ($sqroot - 1)) {

            if($this->items[$i] == $value) {

                $result = $i;

                break;
            }

            if($this->items[$i] < $value) {

                for($j = $i; $j < $i + ($sqroot - 1); $j++) {

                    if($this->items[$j] == $value) {

                        $result = $j;

                        break;
                    }
                }
            }
        }

        return (int) $result;
    }

   /**
    * Find an item by linier search algorithm.
    *
    * @param mixed $item
    * @return int
    */
    public function byLinier($item) : int
    {
        $result = -1;

        for($i = 0; $i < count($this->items); $i++) {

            if($this->items[$i] == $item) {

                $result = $i;
                break;
            }
        }

        return $result;
    }

   /**
    * Verify if the numeric items is sorted or not.
    *
    * @return void
    */
    protected function verify()
    {
        $result = true;

        for($i = 0; $i < count($this->items) - 1; $i++) {

            if(!isset($this->items[$i + 1])) {
                
                break;
            }

            if( !is_numeric($this->items[$i])
                ||
                $this->items[$i] > $this->items[$i + 1] ) {

                $result = false;

                break;
            }
        }

        if($result === false) {

            throw new Exception("List of the items is not sorted yet and must be numeric data type");
        }
    }
}

