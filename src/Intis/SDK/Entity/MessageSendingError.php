<?php

namespace Intis\SDK\Entity;

use Intis\SDK\Exception\SDKException;

class MessageSendingError extends MessageSendingResult
{

    private $code;

    public function __construct()
    {
        $this->setIsOk(false);
    }

    /**
     * @return Code error in SMS sending
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     *
     * @param code - Code error
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return Error text
     */
    public function getMessage()
    {
        return SDKException::$messages[$this->code];
    }
}