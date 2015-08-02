<?php

namespace Intis\SDK\Entity;

class MessageSendingSuccess extends MessageSendingResult
{
    private $messageId;

    private $cost;

    private $currency;

    private $messagesCount;

    public function __construct()
    {
        $this->setIsOk(true);
    }

    /**
     * @return Message ID
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return Price for message
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return Name of currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return Number of message parts
     */
    public function getMessagesCount()
    {
        return $this->messagesCount;
    }

    /**
     * @param mMessageId - Message ID
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * @param mCost - Price for message
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @param mCurrency - Name of currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param mMessagesCount - Number of message parts
     */
    public function setMessagesCount($messagesCount)
    {
        $this->messagesCount = $messagesCount;
    }
}