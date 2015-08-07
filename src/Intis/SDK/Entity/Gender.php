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
 * Class Gender
 * Getting gender of subscriber
 *
 * @package Intis\SDK\Entity
 */
class Gender{
    /**
     * @const Constant for male
     */
    const MALE = 1;
    /**
     * @const Constant for female
     */
    const FEMALE = 2;
    /**
     * @const Constant for undefined gender
     */
    const UNDEFINED = 3;
    
    /**
     * Parsing a string for getting gender of subscriber
     *
     * @param string $string
     * @return integer
     */
    public static function parse($string){
        switch ($string){
            case 'm':
                return self::MALE;
            case 'f':
                return self::FEMALE;
            default :
                return self::UNDEFINED;
        }
    }
}
