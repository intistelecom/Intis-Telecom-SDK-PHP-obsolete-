<?php
namespace Intis\SDK\Entity;

/**
 * Class IncomingMessage
 *
 * Class for getting incoming message
 *
 * @package Intis\SDK\Entity
 */
class IncomingMessage{
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var string Date of message receiving
     */
    private $receivedAt;
    /**
     * @var string Sender name
     */
    private $originator;
    /**
     * @var string Prefix of the incoming message
     */
    private $prefix;
    /**
     * @var string Text of message
     */
    private $text;
    
    public function __construct($messageId, $obj) {
        $this->messageId = $messageId;
        $this->receivedAt = $obj->date;
        $this->originator = $obj->sender;
        $this->prefix = $obj->prefix;
        $this->text = $obj->text;
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
     * Getting date of the incoming message
     *
     * @return string
     */
    public function getReceivedAt() {
        return $this->receivedAt;
    }

    /**
     * Getting sender name of the incoming message
     *
     * @return string
     */
    public function getOriginator() {
        return $this->originator;
    }

    /**
     * Getting prefix of the incoming message
     *
     * @return string
     */
    public function getPrefix() {
        return $this->prefix;
    }

    /**
     * Getting text of the incoming message
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }
}
