<?php
/**
 * RuntimeExceptionTest
 *
 * @package    nsingapuri
 * @subpackage exception
 * @author     Nalin Singapuri - http://nalin.singapuri.com
 * @copyright  2016
 * @license    GPL
 * @link       https://github.com/nsingapuri/exception
 *
 * PHP version >= 5.5
 **/

use nsingapuri\exception\RuntimeException;

/**
 * RuntimeExceptionTest: Unit test for RuntimeException class
 **/
class RuntimeExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text RuntimeException::__construct()
     *
     * @covers RuntimeException::__construct()
     * @return void
     */
    public function testConstructor()
    {
        $message = 'message';

        $e = new RuntimeExceptionMock($message);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "$message");

    }


}

/**
 * RuntimeExceptionMock: mock which extends the RuntimeException class, as the base class is abstract
 **/
class RuntimeExceptionMock extends RuntimeException
{
}
