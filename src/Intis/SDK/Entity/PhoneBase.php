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
 * Class PhoneBase
 * Class for getting data of phone number list
 *
 * @package Intis\SDK\Entity
 */
class PhoneBase{
    /**
     * @var integer List ID
     */
    private $baseId;
    /**
     * @var string List name
     */
    private $title;
    /**
     * @var integer Number of contacts in list
     */
    private $count;
    /**
     * @var integer Number of pages in list
     */
    private $pages;
    /**
     * @var integer Key send/do not send birthday greetings
     */
    private $birthdayGreetingSettings;
    
    public function __construct($baseId, $obj) {
        $this->baseId = $baseId;
        $this->title = $obj->name;
        $this->count = $obj->count;
        $this->pages = $obj->pages;
        $this->birthdayGreetingSettings = new BirthdayGreetingSettings($obj);
    }
    
    /**
     * Getting list ID
     *
     * @return integer
     */
    public function getBaseId(){
        return $this->baseId;
    }
    
    /**
     * Getting list name
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Getting number of contacts in list
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * Getting number of pages in list
     *
     * @return integer
     */
    public function getPages() {
        return $this->pages;
    }

    /**
     * Getting key of sending birthday greetings. 0 - do not send, 1 - send.
     *
     * @return integer
     */
    public function getBirthdayGreetingSettings() {
        return $this->birthdayGreetingSettings;
    }
}

