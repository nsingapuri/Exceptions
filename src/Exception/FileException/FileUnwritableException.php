<?php
/**
 * FileUnwritableException
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

namespace nsingapuri\exception\FileException;

/**
 * FileUnwritableException: FileUnopenableException for when a file cannot be opened in write or append mode
 **/
class FileUnwritableException extends FileUnopenableException
{


    /**
     * Constructor
     *
     * @param string    $fileName The name of the file.
     * @param string    $message  The message.
     * @param integer   $code     The error code.
     * @param Exception $previous The prior Exception.
     *
     * @return FileUnopenableException
     **/
    public function __construct($fileName, $message='cannot be opened for writing', $code=0, Exception $previous=null)
    {
        parent::__construct($fileName, $message, $code, $previous);

    }


}
