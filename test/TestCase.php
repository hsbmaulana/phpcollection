<?php

declare(strict_types=1);

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public static function setUpBeforeClass() : void { fwrite(STDOUT, __METHOD__ . "\n"); }

    /**
     * @return void
     */
    protected function setUp() : void { fwrite(STDOUT, __METHOD__ . "\n"); }

    /**
     * @return void
     */
    protected function tearDown() : void { fwrite(STDOUT, __METHOD__ . "\n"); }

    /**
     * @return void
     */
    public static function tearDownAfterClass() : void { fwrite(STDOUT, __METHOD__ . "\n"); }
}