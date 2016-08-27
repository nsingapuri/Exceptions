<?php
/**
 * File
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

use nsingapuri\file\FileMode;
use nsingapuri\exception\FileException\FileNotFoundException;
use nsingapuri\exception\FileException\FileUnopenableException;
use nsingapuri\exception\FileException\FileUnreadableException;
use nsingapuri\exception\FileException\FileUnwritableException;

/**
 * File: an abstract class for file input output
 **/
abstract class File
{

    /**
     * The files name
     *
     * @var string
     **/
    protected $fileName;

    /**
     * Path to the directory
     *
     * @var string
     **/
    protected $directoryName;

    /**
     * A handle for the file
     *
     * @var FileMode
     **/
    protected $mode;

    /**
     * A handle for the file
     *
     * @var resource
     **/
    protected $handle;


    /**
     * Constructor
     *
     * @param string   $path A relative path/to/file or absolute /path/to/file.
     * @param FileMode $mode The mode in which to open the file.
     *
     * @return File
     **/
    public function __construct($path, FileMode $mode)
    {
        $path = pathinfo($path);

        $this->fileName      = $path['basename'];
        $this->directoryName = $path['dirname'].'/';
        $this->mode          = $mode;

        $this->open();

    }


    /**
     * Destructor
     **/
    public function __destruct()
    {
        $this->close();

    }


    /**
     * Verifies that $path can be opened
     *
     * @param string $path The path to a file or directory.
     *
     * @return boolean
     *
     * @throws FileNotFoundException File cannot be found.
     * @throws FileUnreadableException File cannot be read.
     * @throws FileUnwritableException File directory cannot be written to.
     * @throws \InvalidArgumentException $this->mode is invalid.
     **/
    protected function isValid($path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException($path);
        }

        switch ($this->mode) {
            case FileMode::READ:
                if (!is_readable($path)) {
                    throw new FileUnreadableException($path);
                }
            break;

            case FileMode::WRITE:
                if (!is_writable($path)) {
                    throw new FileUnwritableException($path);
                }
            break;

            case FileMode::APPEND:
                if (!is_readable($path)) {
                    throw new FileUnreadableException($path);
                } else if (!is_writable($path)) {
                    throw new FileUnwritableException($path);
                }
            break;

            default:
                throw new \InvalidArgumentException("\$this->mode ({$this->mode}) is invalid");
            break;
        }

        return true;

    }


    /**
     * Opens $fileName in $mode and sets $handle
     *
     * @return boolean
     *
     * @throws FileUnopenableException File cannot be opened.
     */
    protected function open()
    {
        $path = "{$this->directoryName}{$this->fileName}";

        try {
            $this->isValid($path);
        } catch (FileNotFoundException $e) {
            // File does not exist, lets see if we are in write or append mode and the directory is writable.
            if (in_array($this->mode, [FileMode::WRITE, FileMode::APPEND])) {
                $this->isValid($this->directoryName);
            }
        } catch (FileUnwritableException $e) {
            // File is not writable, lets see if the directory is writable.
            $this->isValid($this->directoryName);
        }

        // Open file.
        $this->handle = @fopen($path, $this->mode);
        if ($this->handle === false) {
            throw new FileUnopenableException($this->fileName);
        }

        return true;

    }


    /**
     * Closes $handle
     *
     * @return boolean
     */
    protected function close()
    {
        if (is_resource($this->handle)
            && get_resource_type($this->handle) === 'stream'
        ) {
            fclose($this->handle);
            return true;
        }

        return false;

    }


}
