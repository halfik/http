<?php namespace Netinteractive\Http\Exception;


class DownloadParamsException extends \Exception
{
    /**
     * @param array $field
     * @param array $fk
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct(array $field, $message = "", $code = 0, Exception $previous = null)
    {
        if (empty($message)){
            $message = sprintf( _("Missing download parameter: %s"), $field );
        }

        parent::__construct($message, $code, $previous);
    }
}