<?php
/**
 * Created by PhpStorm.
 * User: smy
 * Date: 18-3-2
 * Time: 下午4:16
 */

namespace yang\exception;

class FileNotFoundException extends \RuntimeException
{
    public $type;

    public function __construct($filename = "", $code = 0, $file = '', $line = 0)
    {
        $message = ' File Not Found, Path: ' . $filename;
        if (empty($file)) {
            $debug = debug_backtrace()[0];
            $file = $debug['file'];
            $line = $debug['line'];
        }

        $this->file = $file;
        $this->line = $line;

        parent::__construct($message, $code);
    }
}