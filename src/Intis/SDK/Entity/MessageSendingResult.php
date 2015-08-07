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
class MessageSendingResult
{
    /**
     * @var string Phone number
     */
    private $phone;

    /**
     * @var boolean Success result
     */
    private $isOk;

    /**
     * Getting phone number
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * If key is ok
     *
     * @return boolean
     */
    public function isOk()
    {
        return $this->isOk;
    }

    /**
     * @param phone - Phone number
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Setting success result
     *
     * @param boolean $isOk
     */
    public function setIsOk($isOk)
    {
        $this->isOk = $isOk;
    }
}
