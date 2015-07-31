<?php
namespace Intis\SDK\Entity;

/**
 * Class Network
 *
 * Class for getting operator of subscriber
 *
 * @package Intis\SDK\Entity
 */
class Network{
    /**
     * @var string Name of operator
     */
    private $title;
    
    function __construct($obj) {
        $this->title = $obj->operator;
    }
    
    /**
     * Getting operator of subscriber
     *
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

}
