<?php
namespace Intis\SDK\Entity;

/**
 * Class PhoneBase
 *
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

