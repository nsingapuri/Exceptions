<?php
/**
 * ExceptionTest
 *
 * @package    nsingapuri
 * @subpackage files
 * @author     Nalin Singapuri - http://nalin.singapuri.com
 * @copyright  2016
 * @license    GPL
 * @link       https://github.com/nsingapuri/files
 *
 * PHP version >= 5.5
 **/

use nsingapuri\exception\Exception;

/**
 * ExceptionTest: unit test for Exception class
 **/
class ExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Test Exception::__construct()
     *
     * @return void
     *
     * @covers nsingapuri\exception\Exception::__construct()
     */
    public function testConstruct()
    {
        $e = new ExceptionMock('this is a test');
        $this->assertInstanceOf(nsingapuri\exception\exception::class, $e);
        $this->assertInstanceOf(\exception::class, $e);

    }


}

/**
 * ExceptionMock: mock which extends abstract Exception class
 **/
class ExceptionMock extends Exception
{
}
