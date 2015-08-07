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
 * Class PhoneBaseItem
 * Class of getting subscriber data in list
 *
 * @package Intis\SDK\Entity
 */
class PhoneBaseItem{
    /**
     * @var int|string Phone number of subscriber
     */
    private $phone;
    /**
     * @var string Subscriber name
     */
    private $firstName;
    /**
     * @var string Subscriber middle name
     */
    private $middleName;
    /**
     * @var string Subscriber last name
     */
    private $lastName;
    /**
     * @var string Subscriber birth date
     */
    private $birthDay;
    /**
     * @var string Gender of subscriber
     */
    private $gender;
    /**
     * @var string Region of subscriber
     */
    private $area;
    /**
     * @var string Operator of subscriber
     */
    private $network;
    /**
     * @var string Note 1
     */
    private $note1;
    /**
     * @var string Note 2
     */
    private $note2;
    
    public function __construct($phone, $obj) {
        $this->phone = $phone;
        $this->firstName = $obj->name;
        $this->middleName = $obj->middle_name;
        $this->lastName = $obj->last_name;
        $this->birthDay = $obj->date_birth;
        $this->gender = $obj->male;
        $this->area = $obj->region;
        $this->network = $obj->operator;
        $this->note1 = $obj->note1;
        $this->note2 = $obj->note2;
    }
    
    /**
     * Getting subscriber number
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Getting subscriber first name
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Getting subscriber middle name
     *
     * @return string
     */
    public function getMiddleName() {
        return $this->middleName;
    }

    /**
     * Getting subscriber last name
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Getting subscriber birthday
     *
     * @return string
     */
    public function getBirthDay() {
        return $this->birthDay;
    }

    /**
     * Getting gender of subscriber
     *
     * @return integer
     */
    public function getGender() {
        return Gender::parse($this->gender);
    }

    /**
     * Getting region of subscriber
     *
     * @return string
     */
    public function getArea() {
        return $this->area;
    }

    /**
     * Getting operator of subscriber
     *
     * @return string
     */
    public function getNetwork() {
        return $this->network;
    }

    /**
     * Getting subscriber note 1
     *
     * @return string
     */
    public function getNote1() {
        return $this->note1;
    }

    /**
     * Getting subscriber note 2
     *
     * @return string
     */
    public function getNote2() {
        return $this->note2;
    }
}
