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
 * Class HLRStatItem
 * Class of statistics by HLR requests
 *
 * @package Intis\SDK\Entity
 */
class HLRStatItem extends HLRResponse {

    /**
     * @var int|string Phone number
     */
    private $phone;
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var float Final price
     */
    private $totalPrice;
    /**
     * @var integer Request ID
     */
    private $requestId;
    /**
     * @var string Time of HLR request
     */
    private $requestTime;

    public function __construct($phone, $obj) {
        parent::__construct($obj);
        $this->phone = $phone;
        $this->messageId = $obj->message_id;
        $this->totalPrice = $obj->total_price;
        $this->requestId = $obj->request_id;
        $this->requestTime = $obj->request_time;
    }
    
    /**
     * Getting phone number
     *
     * @return string
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
     * Getting final price of request
     *
     * @return float
     */
    public function getTotalPrice() {
        return $this->totalPrice;
    }

    /**
     * Getting request ID
     *
     * @return integer
     */
    public function getRequestId() {
        return $this->requestId;
    }

    /**
     * Getting time of request
     *
     * @return string
     */
    public function getRequestTime() {
        return $this->requestTime;
    }
}
