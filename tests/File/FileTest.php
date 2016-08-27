<?php
/**
 * FileTest
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

use nsingapuri\file\File;
use nsingapuri\file\FileMode;

/**
 * FileTest: unit test for File class
 **/
class FileTest extends PHPUnit_Framework_TestCase
{


    /**
     * Text File::__construct() to ensure it sets file::$fileName
     *
     * @param string[] $methods The methods to mock.
     *
     * @return FileMock
     */
    public function getFile(array $methods=null)
    {
        $file = $this->getMockBuilder(FileMock::class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        return $file;

    }


    /**
     * Text File::__construct() to ensure it sets File::$fileName
     *
     * @return void
     *
     * @covers nsingapuri\file\File::__construct()
     */
    public function testConstructSetsFileName()
    {
        $file = $this->getFile(['open']);
        $file->expects($this->any())
            ->method('open')
            ->willReturn('true');

        $fileName      = 'null';
        $directoryName = '/dev/';
        $mode          = new FileMode(FileMode::READ);

        $file->__construct("{$directoryName}{$fileName}", $mode);
        $this->assertEquals($file->fileName, $fileName);

    }


    /**
     * Text File::__construct() to ensure it sets File::$filePath
     *
     * @return void
     *
     * @covers nsingapuri\file\File::__construct()
     */
    public function testConstructSetsFilePath()
    {
        $file = $this->getFile(['open']);
        $file->expects($this->any())
            ->method('open')
            ->willReturn('true');

        $fileName      = 'null';
        $directoryName = '/dev/';
        $mode          = new FileMode(FileMode::READ);

        $file->__construct("{$directoryName}{$fileName}", $mode);
        $this->assertEquals($file->directoryName, $directoryName);

    }


    /**
     * Text File::__construct() to ensure it sets File::$mode
     *   ensure it calls file::open()
     *
     * @return void
     *
     * @covers nsingapuri\file\File::__construct()
     */
    public function testConstructSetsMock()
    {
        $file = $this->getFile(['open']);
        $file->expects($this->any())
            ->method('open')
            ->willReturn('true');

        $fileName = '/dev/null';
        $mode     = new FileMode(FileMode::READ);

        $file->__construct($fileName, $mode);
        $this->assertEquals($file->mode, $mode);

    }


    /**
     * Text File::__construct() to ensure it calls File::open()
     *
     * @return void
     *
     * @covers nsingapuri\file\File::__construct()
     */
    public function testConstructCallsOpen()
    {
        $file = $this->getFile(['open']);
        $file->expects($this->once())
            ->method('open')
            ->willReturn('true');

        $fileName = '/dev/null';
        $mode     = new FileMode(FileMode::READ);

        $file->__construct($fileName, $mode);

    }


    /**
     * Text File::__destruct() to ensure it calls File::close()
     *
     * @return void
     *
     * @covers nsingapuri\file\File::__destruct()
     */
    public function testDestructCallsClose()
    {
        $file = $this->getFile(['close']);
        $file->expects($this->once())
            ->method('close')
            ->willReturn('true');

        $file->__destruct();

    }


    /**
     * Text File::isValid() to ensure it throws FileNotFoundException for file
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileNotFoundException
     */
    public function testIsValidCallsFileNotFoundExceptionForFile()
    {
        $file = $this->getFile();
        $file->isValid('/invalid/path/to.file');

    }


    /**
     * Text File::isValid() to ensure it throws FileNotFoundException for directory
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileNotFoundException
     */
    public function testIsValidCallsFileNotFoundExceptionForDirectory()
    {
        $file = $this->getFile();
        $file->isValid('/invalid/path/to/directory/');

    }


    /**
     * Text File::isValid() to ensure it throws FileUnreadableException in read mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnreadableException
     */
    public function testIsValidThrowsFileUnreadableExceptionInReadMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::READ);

        $file->isValid('/etc/master.passwd');

    }


    /**
     * Text File::isValid() to ensure it succeeds in read mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     */
    public function testIsValidSucceedsInReadMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::READ);

        $this->assertTrue($file->isValid('/dev/null'));

    }


    /**
     * Text File::isValid() to ensure it throws FileUnwritableException in write mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnwritableException
     */
    public function testIsValidThrowsFileUnwritableExceptionInWriteMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::WRITE);

        $file->isValid('/etc/master.passwd');

    }


    /**
     * Text File::isValid() to ensure it succeeds in write mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     */
    public function testIsValidSucceedsInWriteMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::WRITE);

        $this->assertTrue($file->isValid('/dev/null'));

    }


    /**
     * Text File::isValid() to ensure it throws FileUnreadableException in append mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnreadableException
     */
    public function testIsValidThrowsFileUnreadableExceptionInAppendMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::APPEND);

        $file->isValid('/etc/master.passwd');

    }


    /**
     * Text File::isValid() to ensure it throws FileUnwritableException in append mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnwritableException
     */
    public function testIsValidThrowsFileUnwritableExceptionInAppendMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::APPEND);

        $file->isValid('/etc/group');

    }


    /**
     * Text File::isValid() to ensure it succeeds in append mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     */
    public function testIsValidSucceedsInAppendMode()
    {
        $file       = $this->getFile();
        $file->mode = new FileMode(FileMode::APPEND);

        $this->assertTrue($file->isValid('/dev/null'));

    }


    /**
     * Text File::isValid() to ensure it throws InvalidArgumentException
     *
     * @return void
     *
     * @covers nsingapuri\file\File::isValid()
     *
     * @expectedException InvalidArgumentException
     */
    public function testIsValidThrowsInvalidArgumentException()
    {
        $file       = $this->getFile();
        $file->mode = null;

        $file->isValid('/dev/null');

    }


    /**
     * Text File::open() to ensure it calls File::isValid on a file in read mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnopenableException
     */
    public function testOpenCallsIsValidInReadMode()
    {
        $file                = $this->getFile(['isValid']);
        $file->directoryName = '/path/to/';
        $file->fileName      = 'file';
        $file->mode          = new FileMode(FileMode::READ);

        $file->expects($this->once())
            ->method('isValid')
            ->with("{$file->directoryName}{$file->fileName}")
            ->willReturn('true');

        $file->open();

    }


    /**
     * Text File::open() to ensure it calls File::isValid twice on a file and on directory in write mode when
     *   FileNotFoundException is thrown by isValid
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnopenableException
     */
    public function testOpenCallsIsValidTwiceForFileNotFoundException()
    {
        $file                = $this->getFile(['isValid']);
        $file->directoryName = '/path/to/';
        $file->fileName      = 'file';
        $file->mode          = new FileMode(FileMode::WRITE);

        $e = new nsingapuri\exception\FileException\FileNotFoundException('');

        $file->expects($this->at(0))
            ->method('isValid')
            ->with("{$file->directoryName}{$file->fileName}")
            ->willThrowException($e);

        $file->expects($this->at(1))
            ->method('isValid')
            ->with("{$file->directoryName}")
            ->willReturn('true');

        $file->open();

    }


    /**
     * Text File::open() to ensure it calls File::isValid twice on a file and on directory in write mode when
     *   FileUnwritableException is thrown by isValid
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     *
     * @expectedException nsingapuri\exception\FileException\FileUnopenableException
     */
    public function testOpenCallsIsValidTwiceForFileUnwritableException()
    {
        $file                = $this->getFile(['isValid']);
        $file->directoryName = '/path/to/';
        $file->fileName      = 'file';
        $file->mode          = new FileMode(FileMode::WRITE);

        $e = new nsingapuri\exception\FileException\FileUnwritableException('');

        $file->expects($this->at(0))
            ->method('isValid')
            ->with("{$file->directoryName}{$file->fileName}")
            ->willThrowException($e);

        $file->expects($this->at(1))
            ->method('isValid')
            ->with("{$file->directoryName}")
            ->willReturn('true');

        $file->open();

    }


    /**
     * Text File::open() to ensure it works in read mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     */
    public function testOpenSucceedsInReadMode()
    {
        $file                = $this->getFile();
        $file->mode          = null;
        $file->directoryName = '/dev/';
        $file->fileName      = 'null';
        $file->mode          = new FileMode(FileMode::READ);

        $file->open();

    }


    /**
     * Text File::open() to ensure it works in write mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     */
    public function testOpenSucceedsInWriteMode()
    {
        $file                = $this->getFile();
        $file->mode          = null;
        $file->directoryName = '/dev/';
        $file->fileName      = 'null';
        $file->mode          = new FileMode(FileMode::WRITE);

        $file->open();

    }


    /**
     * Text File::open() to ensure it works in append mode
     *
     * @return void
     *
     * @covers nsingapuri\file\File::open()
     */
    public function testOpenSucceedsInAppendMode()
    {
        $file                = $this->getFile();
        $file->mode          = null;
        $file->directoryName = '/dev/';
        $file->fileName      = 'null';
        $file->mode          = new FileMode(FileMode::APPEND);

        $file->open();

    }


    /**
     * Text File::close() to ensure it ignores null File::$handle
     *
     * @return void
     *
     * @covers nsingapuri\file\File::close()
     */
    public function testCloseIgnoresBadHandle()
    {
        $file = $this->getFile();

        $file->fileName = '/dev/null';
        $file->mode     = new FileMode(FileMode::READ);

        $result = $file->close();
        $this->assertFalse($result);

    }


    /**
     * Text File::close() to ensure to ensure it sets File::$handle
     *
     * @return void
     *
     * @covers nsingapuri\file\File::close()
     */
    public function testCloseClosesHandle()
    {
        $file = $this->getFile();

        $file->fileName = '/dev/null';
        $file->mode     = new FileMode(FileMode::READ);
        $file->open();

        $result = $file->close();
        $this->assertTrue($result);

    }


}

/**
 * FileMock: mock which extends abstract File class and opens up protected properties and methods
 **/
class FileMock extends File
{

    public $fileName;

    public $directoryName;

    public $mode;

    public $handle;

    public function open()
    {
        return parent::open();

    }

    public function isValid($path)
    {
        return parent::isValid($path);

    }


    public function close()
    {
        return parent::close();

    }


}
