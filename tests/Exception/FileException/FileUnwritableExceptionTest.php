<?php
/**
 * FileUnwritableExceptionTest
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

use nsingapuri\exception\FileException\FileUnwritableException;

/**
 * FileUnwritableExceptionTest: Unit test for FileUnwriteableException class
 **/
class FileUnwritableExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text FileUnwriteableException::__construct()
     *
     * @return void
     *
     * @covers nsingapuri\exception\FileException\FileUnwritableException::__construct()
     */
    public function testConstructor()
    {
        $filename = 'file';

        $e = new FileUnwritableException($filename);
        $this->assertInstanceOf(nsingapuri\exception\FileException\FileUnopenableException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "{$filename}: cannot be opened for writing");

    }


}
