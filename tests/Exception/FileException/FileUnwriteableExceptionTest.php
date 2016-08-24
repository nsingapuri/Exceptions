<?php
/**
 * FileUnwriteableExceptionTest
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

use nsingapuri\exception\FileException\FileUnwriteableException;

/**
 * FileUnwriteableExceptionTest: Unit test for FileUnwriteableException class
 **/
class FileUnwriteableExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text FileUnwriteableException::__construct()
     *
     * @covers FileUnwriteableException::__construct()
     * @return void
     */
    public function testConstructor()
    {
        $filename = 'file';

        $e = new FileUnwriteableException($filename);
        $this->assertInstanceOf(nsingapuri\exception\FileException\FileUnopenableException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "{$filename}: cannot be opened for writing");

    }


}
