<?php

/**
 * Custom exception for possible errors in Frame class.
 * @extends Exception
 */
class FrameException extends Exception
{
    /**
     * __construct
     * FrameException constructor method.
     *
     * @param  mixed $message Exception message.
     * @param  mixed $code
     * @param  mixed $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * __toString
     * Method which returns human-readable exception message.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

?>
