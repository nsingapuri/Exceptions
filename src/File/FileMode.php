<?php
/**
 * FileMode
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
use MyCLabs\Enum\Enum;

/**
 * FileMode enumerated modes for File::READ, File::WRITE, File::APPEND
 **/
class FileMode extends Enum
{

    const READ   = 'r';
    const WRITE  = 'w';
    const APPEND = 'a';


}
