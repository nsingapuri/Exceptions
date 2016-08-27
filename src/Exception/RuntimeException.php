<?php
/**
 * RuntimeException
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

/**
 * RuntimeException: base class for Runtime Exceptions
 **/
abstract class RuntimeException extends \RuntimeException
{


    /**
     * Constructor
     *
     * @param string    $message  The message.
     * @param integer   $code     The error code.
     * @param Exception $previous The prior Exception.
     *
     * @return Exception
     **/
    public function __construct($message, $code=0, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);

    }


}
