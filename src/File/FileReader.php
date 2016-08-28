<?php
/**
 * FileReader
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

namespace nsingapuri\file;

use nsingapuri\file\File;
use nsingapuri\exception\FileException\EndOfFileException;

/**
 * FileReader: a class for reading files
 **/
class FileReader extends File
{


    /**
     * Constructor
     *
     * @param string $path A relative path/to/file or absolute /path/to/file.
     *
     * @return FileReader
     **/
    public function __construct($path)
    {
        $mode = new FileMode(FileMode::READ);
        return parent::__construct($path, $mode);

    }


    /**
     * Read a single line from $handle
     *
     * @return string
     *
     * @throws EndOfFileException EOF has been reached.
     **/
    public function readLine()
    {
        $buffer = fgets($this->handle);
        if ($buffer === false) {
            throw new EndOfFileException("{$this->directoryName}{$this->fileName}");
        }

        return trim($buffer);

    }


    /**
     * Read a multiple lines from $handle until hitting $delimiter or EOF
     *
     * @param string $delimiter A delimiter line which will trigger return of all content read. Discards the delimiter.
     *
     * @return string
     *
     * @throws EndOfFileException EOF has been reached.
     **/
    public function readSection($delimiter)
    {
        $returnVal = [];

        try {
            while (true) {
                $buffer = $this->readLine();

                if ($buffer == $delimiter) {
                    break;
                } else {
                    $returnVal[] = $buffer;
                }
            }
        } catch (EndOfFileException $e) {
            if (!count($returnVal)) {
                // We hit EOF but have no content in $returnVal, pass the exception up.
                throw $e;
            }
        }

        return $returnVal;

    }


}
