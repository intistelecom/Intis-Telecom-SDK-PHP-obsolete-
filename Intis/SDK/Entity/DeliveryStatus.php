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
    
    public function __construct($messageId, $messageStatus) {
        $this->messageId = $messageId;
        $this->messageStatus = $messageStatus;
    }
    
    /**
     * Получение Message ID
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
}
