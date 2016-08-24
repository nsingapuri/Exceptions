<?php
/**
 * FileExceptionTest
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

use nsingapuri\exception\FileException;

/**
 * FileExceptionTest: Unit test for FileException class
 **/
class FileExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text FileException::__construct()
     *
     * @covers FileException::__construct()
     * @return void
     */
    public function testConstructor()
    {
        $filename = 'file';
        $message  = 'message';

        $e = new FileExceptionMock($filename, $message);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "$filename: $message");

    }


}

/**
 * FileExceptionMock: mock which extends the FileException class, as the base class is abstract
 **/
class FileExceptionMock extends FileException
{
}
