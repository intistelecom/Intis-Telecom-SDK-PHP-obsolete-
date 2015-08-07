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
 * Class Template
 * Class for getting user templates
 *
 * @package Intis\SDK\Entity
 */
class Template{
    /**
     * @var integer Template ID
     */
    private $id;
    /**
     * @var string Template name
     */
    private $title;
    /**
     * @var string Text of template
     */
    private $template;
    /**
     * @var string Time of adding template
     */
    private $createdAt;
    
    public function __construct($id, $obj) {
        $this->id = $id;
        $this->title = $obj->name;
        $this->template = $obj->template;
        $this->createdAt = $obj->up_time;
    }

    /**
     * Getting template ID
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Getting template name
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Getting text of template
     *
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Getting time of template
     *
     * @return string
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
}

