<?php
namespace Intis\SDK\Entity;

/**
 * Class Originator
 *
 * Class for getting sender status
 *
 * @package Intis\SDK\Entity
 */
class Originator{
    /**
     * @var string Sender name
     */
    private $originator;
    /**
     * @var string Sender status
     */
    private $state;
    
    public function __construct($originator, $state) {
        $this->originator = $originator;
        $this->state = $state;
    }

    /**
     * Getting sender name
     *
     * @return string
     */
    public function getOriginator() {
        return $this->originator;
    }

    /**
     * Getting sender status
     *
     * @return integer
     */
    public function getState() {
        return OriginatorState::parse($this->state);
    }
}

