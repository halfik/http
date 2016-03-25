<?php namespace Netinteractive\Http\Exception;

/**
 * Class StreamParamsException
 * @package Netinteractive\Http\Exception
 */
class StreamParamsException extends \Exception
{
    /**
     * @param string $field
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($field, $message = "", $code = 0, Exception $previous = null)
    {
        if (empty($message)){
            $message = sprintf( _("Missing stream parameter: %s"), $field );
        }

        parent::__construct($message, $code, $previous);
    }
}