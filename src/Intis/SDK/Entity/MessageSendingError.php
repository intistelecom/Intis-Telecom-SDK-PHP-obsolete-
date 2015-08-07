<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Intis Telecom
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Intis\SDK\Entity;

use Intis\SDK\Exception\SDKException;

/**
 * Class MessageSendingError
 * Class for the message sending result with error
 *
 * @package Intis\SDK\Entity
 */
class MessageSendingError extends MessageSendingResult
{
    /**
     * @var int Code error in SMS sending
     */
    private $code;

    public function __construct()
    {
        $this->setIsOk(false);
    }

    /**
     * Getting code error in SMS sending
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Setting code error
     *
     * @param integer $code - Code error
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Getting error text in SMS sending
     *
     * @return string
     */
    public function getMessage()
    {
        return SDKException::$messages[$this->code];
    }
}