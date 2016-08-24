<?php
/**
 * Exception
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

namespace nsingapuri\exception;

/**
 * Exception: base class extending /Exception
 **/
abstract class Exception extends \Exception
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
        parent::__construct();

    }


}
