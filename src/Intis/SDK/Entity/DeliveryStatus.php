<?php
namespace Intis\SDK\Entity;

/**
 * Class DeliveryStatus
 *
 * Class for getting message statuses
 *
 * @package Intis\SDK\Entity
 */
class DeliveryStatus{
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var string message status
     */
    private $messageStatus;

    /**
     * @var string time of message
     */
    private $createdAt;
    
    public function __construct($obj) {
        $this->messageId = $obj->messageId;
        $this->messageStatus = $obj->status;
        $this->createdAt = $obj->time;
    }
    
    /**
     * Getting message ID
     *
     * @return integer
     */
    public function getMessageId() {
        return $this->messageId;
    }

    /**
     * Getting a message status
     *
     * @return integer
     */
    public function getMessageStatus() {
        return MessageState::parse($this->messageStatus);
    }

    /**
     * Getting a time of message
     *
     * @return string
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }
}
