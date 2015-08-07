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
 * Class OriginatorState
 * Class for analysis sender status
 *
 * @package Intis\SDK\Entity
 */
class OriginatorState{
    /**
     * @const Constant for approved sender
     */
    const COMPLETED = 1;
    /**
     * @const Constant for the sender that is in moderation queue
     */
    const MODERATION = 2;
    /**
     * @const Constant of the rejected message
     */
    const REJECTED = 3;

    /**
     * Analysis of the string of sender status
     *
     * @param string $string Sender's status
     * @return integer
     */
    public static function parse($string){
          if ($string == 'completed'){
                return self::COMPLETED;
          }
          else if ($string == 'order'){
                return self::MODERATION;
          }
          else if ($string == 'rejected'){
                return self::REJECTED;
          }
          return null;
    }
}