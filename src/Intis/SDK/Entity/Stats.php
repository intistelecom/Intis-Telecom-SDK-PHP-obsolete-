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
 * Class Stats
 * Class for getting statistics
 *
 * @package Intis\SDK\Entity
 */
class Stats{
    /**
     * @var integer Status of message
     */
    private $state;
    /**
     * @var float Price for message
     */
    private $cost;
    /**
     * @var string Name of currency
     */
    private $currency;
    /**
     * @var integer Number of message parts
     */
    private $count;
    
    public function __construct($obj) {
        $this->state = $obj->status;
        $this->cost = $obj->cost;
        $this->count = $obj->parts;
    }

    /**
     * Getting status of message
     *
     * @return integer
     */
    public function getState() {
        return MessageState::parse($this->state);
    }

    /**
     * Getting prices of message
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
    public function getCount() {
        return $this->count;
    }
}
