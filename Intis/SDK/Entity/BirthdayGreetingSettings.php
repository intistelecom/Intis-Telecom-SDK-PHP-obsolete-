<?php
namespace Intis\SDK\Entity;

/**
 * Class BirthdayGreetingSettings
 *
 * Getting settings of birthday greetings
 *
 * @package Intis\SDK\Entity
 */
class BirthdayGreetingSettings{
    /**
     * @var integer key that is responsible for sending birthday greetings
     */
    private $enabled;
    /**
     * @var integer number of days to send greetings before
     */
    private $daysBefore;
    /**
     * @var string sender name of greeting SMS
     */
    private $originator;
    /**
     * @var string time for sending greetings
     */
    private $timeToSend;
    /**
     * @var integer use local time of subscriber while SMS sending
     */
    private $useLocalTime;
    /**
     * @var string text template for sending greetings
     */
    private $template;
    
    public function __construct($obj) {
        $this->enabled = $obj->on_birth;
        $this->daysBefore = $obj->day_before;
        $this->originator = $obj->birth_sender;
        $this->timeToSend = $obj->time_birth;
        $this->useLocalTime = $obj->local_time;
        $this->template = $obj->birth_text;
    }

    /**
     * Getting key that is responsible for sending greetings, 0 - do not send, 1 - send
     *
     * @return integer
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Getting the number of days to send greetings before
     *
     * @return integer
     */
    public function getDaysBefore() {
        return $this->daysBefore;
    }

    /**
     * Getting name of sender for greeting SMS
     *
     * @return string
     */
    public function getOriginator() {
        return $this->originator;
    }

    /**
     * Getting time for sending greetings. All SMS will be sent at this time.
     *
     * @return string
     */
    public function getTimeToSend() {
        return $this->timeToSend;
    }

    /**
     * Getting variable that indicates using of local time while SMS sending.
     *
     * @return integer
     */
    public function getUseLocalTime() {
        return $this->useLocalTime;
    }

    /**
     * Getting text template that will be used in the messages.
     *
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }
}

