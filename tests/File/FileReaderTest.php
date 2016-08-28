<?php
/**
 * FileReaderTest
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

use nsingapuri\file\FileReader;
use nsingapuri\file\FileMode;

/**
 * FileReaderTest: unit test for FileReader class
 **/
class FileReaderTest extends PHPUnit_Framework_TestCase
{


    /**
     * Get a FileReaderMock test double, with $methods ready to be overridden
     *
     * @param string[] $methods The methods to mock.
     *
     * @return FileReaderMock
     */
    public function getFileReader(array $methods=null)
    {
        $file = $this->getMockBuilder(FileReaderMock::class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        return $file;

    }


    /**
     * Test FileReader::__construct() to ensure it sets File::$fileName
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::__construct()
     */
    public function testConstructSetsCorrectMode()
    {
        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('/dev/null');

        $this->assertEquals($fileReader->mode, $mode);

    }


    /**
     * Test FileReader::readLine() to ensure it correctly reads lines
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readLine()
     */
    public function testReadLineReadsLines()
    {
        $fileContent = [
            'foo',
            'bar',
            'baz',
        ];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $this->assertEquals($fileContent[0], $fileReader->readLine());
        $this->assertEquals($fileContent[1], $fileReader->readLine());
        $this->assertEquals($fileContent[2], $fileReader->readLine());

    }


    /**
     * Test FileReader::readLine() to ensure it correctly throws EndOfFileException
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readLine()
     *
     * @expectedException nsingapuri\exception\FileException\EndOfFileException
     */
    public function testReadLineReadsAndThrowsEndOfFileExceptionForEmptyFile()
    {
        $fileContent = [];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        // We have read the entire file, this one should throw.
        $fileReader->readLine();

    }


    /**
     * Test FileReader::readLine() to ensure it correctly throws EndOfFileException
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readLine()
     *
     * @expectedException nsingapuri\exception\FileException\EndOfFileException
     */
    public function testReadLineReadsAndThrowsEndOfFileExceptionForPopulatedFile()
    {
        $fileContent = ['foo'];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $this->assertEquals($fileContent[0], $fileReader->readLine());

        // We have read the entire file, this one should throw.
        $fileReader->readLine();

    }


    /**
     * Test FileReader::readSection() to ensure it correctly reads a delimited section
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readSection()
     */
    public function testReadSectionReadsSectionEndingInDelimiter()
    {
        $fileContent = [
            'foo',
            'bar',
            'baz',
            '===',
        ];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $delimiter = array_pop($fileContent);

        $this->assertEquals($fileContent, $fileReader->readSection($delimiter));

    }


    /**
     * Test FileReader::readSection() to ensure it correctly handles EOF
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readSection()
     */
    public function testReadSectionReadsSectionEndingInEOF()
    {
        $fileContent = [
            'foo',
            'bar',
            'baz',
        ];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $delimiter = '===';

        $this->assertEquals($fileContent, $fileReader->readSection($delimiter));

    }


    /**
     * Test FileReader::readSection() to ensure it correctly returns on EOF and throws on subsequent calls
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readSection()
     *
     * @expectedException nsingapuri\exception\FileException\EndOfFileException
     */
    public function testReadSectionThrowsEndOfFileExceptionForEmptySection()
    {
        $fileContent = [];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $delimiter = '===';

        $fileReader->readSection($delimiter);

    }


    /**
     * Test FileReader::readSection() to ensure it correctly returns on EOF and throws on subsequent calls
     *
     * @return void
     *
     * @covers nsingapuri\file\FileReader::readSection()
     *
     * @expectedException nsingapuri\exception\FileException\EndOfFileException
     */
    public function testReadSectionThrowsEndOfFileExceptionForPopulatedSection()
    {
        $fileContent = [
            'foo',
            'bar',
            'baz',
        ];

        $fileReader = $this->getFileReader();
        $mode       = new FileMode(FileMode::READ);
        $fileReader->__construct('data://text/plain,'.implode(PHP_EOL, $fileContent));

        $delimiter = '===';

        $this->assertEquals($fileContent, $fileReader->readSection($delimiter));
        $fileReader->readSection($delimiter);

    }


}

/**
 * FileReaderMock: mock which extends abstract File class and opens up protected properties and methods
 **/
class FileReaderMock extends FileReader
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
