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
 * Class MessageState
 * Class of analysis of message status
 *
 * @package Intis\SDK\Entity
 */
class MessageState {

    /**
     * @const Constant for scheduled message
     */
    const SCHEDULED = 0;
    /**
     * @const Constant for the message with ENROUTE status
     */
    const ENROUTE = 1;
    /**
     * @const Constant for delivered message
     */
    const DELIVERED = 2;
    /**
     * @const Constant for expired message
     */
    const EXPIRED = 3;
    /**
     * @const Constant for deleted message
     */
    const DELETED = 4;
    /**
     * @const Constant for undelivered message
     */
    const UNDELIVERABLE = 5;
    /**
     * @const Constant for sent message
     */
    const ACCEPTED = 6;
    /**
     * @const Constant for unknown message
     */
    const UNKNOWN = 7;
    /**
     * @const Constant for rejected message
     */
    const REJECTED = 8;
    /**
     * @const Constant for missed message
     */
    const SKIPPED = 9;

    /**
     * Analysis of the string of message status
     *
     * @param string $state message status
     * @return type
     */
    public static function parse($state) {
        switch ($state) {
            case 'deliver':
                return self::DELIVERED;
            case 'expired':
                return self::EXPIRED;
            case 'not_deliver':
                return self::UNDELIVERABLE;
            case 'partly_deliver':
                return self::ACCEPTED;
            default:
                return null;
        }
    }
}
