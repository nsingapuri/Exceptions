<?php
/**
 * FileNotFoundExceptionTest
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

use nsingapuri\exception\FileException\FileNotFoundException;

/**
 * FileNotFoundExceptionTest: Unit test for FileNotFoundException class
 **/
class FileNotFoundExceptionTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text FileNotFoundException::__construct()
     *
     * @covers FileNotFoundException::__construct()
     * @return void
     */
    public function testConstructor()
    {
        $filename = 'file';

        $e = new FileNotFoundException($filename);
        $this->assertInstanceOf(nsingapuri\exception\FileException\FileNotFoundException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\FileException::class, $e);
        $this->assertInstanceOf(nsingapuri\exception\RuntimeException::class, $e);
        $this->assertInstanceOf(\RuntimeException::class, $e);

        $this->assertEquals($e->getMessage(), "{$filename}: not found");

    }


}
