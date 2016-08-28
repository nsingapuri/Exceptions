<?php
/**
 * FileUnreadableExceptionTest
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

use nsingapuri\exception\FileException\FileUnreadableException;

/**
 * FileUnreadableExceptionTest: Unit test for FileUnreadableException class
 **/
class FileUnreadableExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Test FileUnreadableException::__construct()
     *
     * @return void
     *
     * @covers nsingapuri\exception\FileException\FileUnreadableException::__construct()
     */
    public function testConstructor()
    {
        $filename = 'file';

        $e = new FileUnreadableException($filename);
        $this->assertInstanceOf(nsingapuri\exception\FileException\FileUnopenableException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "{$filename}: cannot be opened for reading");

    }


}
