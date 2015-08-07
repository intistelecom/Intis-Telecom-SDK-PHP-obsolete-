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
 * Class DeliveryStatus
 * Class for getting message statuses
 *
 * @package Intis\SDK\Entity
 */
class DeliveryStatus{
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var string message status
     */
    private $messageStatus;

    /**
     * @var string time of message
     */
    private $createdAt;
    
    public function __construct($messageId, $obj) {
        $this->messageId = $messageId;
        $this->messageStatus = $obj->status;
        $this->createdAt = $obj->time;
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
     * Getting a message status
     *
     * @return integer
     */
    public function getMessageStatus() {
        return MessageState::parse($this->messageStatus);
    }

    /**
     * Getting a time of message
     *
     * @return string
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }
}
