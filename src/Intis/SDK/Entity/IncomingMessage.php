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

/**
 * Class IncomingMessage
 * Class for getting incoming message
 *
 * @package Intis\SDK\Entity
 */
class IncomingMessage{
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var string Date of message receiving
     */
    private $receivedAt;
    /**
     * @var string Sender name
     */
    private $originator;
    /**
     * @var string Prefix of the incoming message
     */
    private $prefix;
    /**
     * @var string Text of message
     */
    private $text;

    /**
     * @var string
     */
    private $destination;
    
    public function __construct($messageId, $obj) {
        $this->messageId = $messageId;
        $this->receivedAt = $obj->date;
        $this->originator = $obj->sender;
        $this->prefix = $obj->prefix;
        $this->text = $obj->text;
        $this->destination = $obj->phone;
    }

    /**
     * Getting destination
     *
     * @return string
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * Getting message ID
     *
     * @return integer
     */
    public function getMessageId() {
        return $this->messageId;
    }

    /**
     * Getting date of the incoming message
     *
     * @return string
     */
    public function getReceivedAt() {
        return $this->receivedAt;
    }

    /**
     * Getting sender name of the incoming message
     *
     * @return string
     */
    public function getOriginator() {
        return $this->originator;
    }

    /**
     * Getting prefix of the incoming message
     *
     * @return string
     */
    public function getPrefix() {
        return $this->prefix;
    }

    /**
     * Getting text of the incoming message
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }
}
