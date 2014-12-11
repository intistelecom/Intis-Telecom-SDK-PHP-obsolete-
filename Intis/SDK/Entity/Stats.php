<?php
namespace Intis\SDK\Entity;

/**
 * Class Stats
 *
 * Class for getting statistics
 *
 * @package Intis\SDK\Entity
 */
class Stats{
    /**
     * @var integer Status of message
     */
    private $state;
    /**
     * @var float Price for message
     */
    private $cost;
    /**
     * @var string Name of currency
     */
    private $currency;
    /**
     * @var integer Number of message parts
     */
    private $count;
    
    public function __construct($state, $obj) {
        $this->state = $state;
        $this->cost = $obj->cost;
        $this->count = $obj->parts;
    }

    /**
     * Getting status of message
     *
     * @return integer
     */
    public function getState() {
        return MessageState::parse($this->state);
    }

    /**
     * Getting prices of message
     *
     * @return float
     */
    public function getCost() {
        return $this->cost;
    }

    /**
     * Getting name of currency
     *
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Getting number of message parts
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }
}
