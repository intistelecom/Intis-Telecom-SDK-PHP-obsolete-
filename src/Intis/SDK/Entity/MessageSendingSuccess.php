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
 * Class MessageSendingSuccess
 * Class for successful message sending
 *
 * @package Intis\SDK\Entity
 */
class MessageSendingSuccess extends MessageSendingResult
{
    /**
     * @var string message ID
     */
    private $messageId;
    /**
     * @var float price for message
     */
    private $cost;
    /**
     * @var string name of currency
     */
    private $currency;
    /**
     * @var int number of message parts
     */
    private $messagesCount;

    public function __construct()
    {
        $this->setIsOk(true);
    }

    /**
     * Getting message ID
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Getting price for message
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Getting name of currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Getting number of message parts
     *
     * @return integer
     */
    public function getMessagesCount()
    {
        return $this->messagesCount;
    }

    /**
     * Setting message ID
     *
     * @param string $messageId - Message ID
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * Setting price for message
     *
     * @param float $cost - Price for message
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * Setting name of currency
     *
     * @param string $currency - Name of currency
    */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Setting number of message parts
     *
     * @param int $messagesCount - Number of message parts
     */
    public function setMessagesCount($messagesCount)
    {
        $this->messagesCount = $messagesCount;
    }
}