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
 * Class MessageSendingResult
 * Class of getting response to SMS sending
 *
 * @package Intis\SDK\Entity
 */
class MessageSending{
    /**
     * @var int|string Phone number
     */
    private $phone;
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var float Price of message
     */
    private $cost;
    /**
     * @var string Name of currency
     */
    private $currency;
    /**
     * @var integer Number of message parts
     */
    private $messagesCount;
    /**
     * @return sender
     */
    private $sender;
    /**
     * @return operator
     */
    private $network;

    /**
     * @var string Text of the error while SMS sending
     */
    private $error;

    public function __construct($phone, $params) {
        $this->phone = $phone;
        if(isset($params->id_sms))
            $this->messageId = $params->id_sms;
        if(isset($params->cost))
            $this->cost = $params->cost;
        if(isset($params->count_sms))
            $this->messagesCount = $params->count_sms;
        if(isset($params->sender))
            $this->sender = $params->sender;
        if(isset($params->network))
            $this->network = $params->network;
        if(isset($params->error))
            $this->error = $params->error;
    }

    /**
     * Getting phone number
     *
     * @return int|string
     */
    public function getPhone() {
        return $this->phone;
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
     * Getting price of the message
     *
     * @return float
     */
    public function getCost() {
        return $this->cost;
    }

    /**
     * Getting name of currency
     *
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Getting number of message parts
     *
     * @return integer
     */
    public function getMessagesCount() {
        return $this->messagesCount;
    }

    /**
     * Getting error of SMS sending
     *
     * @return string
     */
    public function getError(){
        return $this->error;
    }

    /**
     * Getting sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Getting operator
     *
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }
}
