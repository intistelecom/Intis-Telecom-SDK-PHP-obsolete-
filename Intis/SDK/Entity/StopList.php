<?php
namespace Intis\SDK\Entity;

/**
 * Class StopList
 *
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
