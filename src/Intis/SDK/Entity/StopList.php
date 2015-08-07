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
 * Class StopList
 * Class for testing number for stop list\
 *
 * @package Intis\SDK\Entity
 */
class StopList{
    /**
     * @var int|string Stop list ID
     */
    private $id;
    /**
     * @var string Time of adding to stop list
     */
    private $timeAddedAt;
    /**
     * @var string Reason for adding to stop list
     */
    private $description;
    
    public function __construct($obj) {
        foreach($obj as $id => $params){
            $this->id = $id;
            $this->timeAddedAt = $params->time_in;
            $this->description = $params->description;
        }
    }

    /**
     * Getting ID in stop list
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Getting time of adding to stop list
     *
     * @return string
     */
    public function getTimeAddedAt() {
        return $this->timeAddedAt;
    }

    /**
     * Getting reason of adding to stop list
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
}
