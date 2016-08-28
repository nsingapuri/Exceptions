<?php
/**
 * EndOfFileExceptionTest
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

use nsingapuri\exception\FileException\EndOfFileException;

/**
 * EndOfFileExceptionTest: Unit test for EndOfFileException class
 **/
class EndOfFileExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Test EndOfFileException::__construct()
     *
     * @return void
     *
     * @covers nsingapuri\exception\FileException\EndOfFileException::__construct()
     */
    public function testConstructor()
    {
        $filename = 'file';

        $e = new EndOfFileException($filename);
        $this->assertInstanceOf(nsingapuri\exception\FileException\EndOfFileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "{$filename}: EOF");

    }


}
