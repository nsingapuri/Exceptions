<?php
/**
 * FileException
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

namespace nsingapuri\exception;
use nsingapuri\exception\RuntimeException;

/**
 * FileException: base class for Exception related to a specific file
 **/
abstract class FileException extends RuntimeException
{


    /**
     * Constructor
     *
     * @param string    $fileName The name of the file.
     * @param string    $message  The message.
     * @param integer   $code     The error code.
     * @param Exception $previous The prior Exception.
     *
     * @return FileException
     **/
    public function __construct($fileName, $message, $code=0, Exception $previous=null)
    {
        parent::__construct("{$fileName}: {$message}", $code, $previous);

    }


}
