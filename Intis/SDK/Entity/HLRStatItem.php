<?php
namespace Intis\SDK\Entity;

/**
 * Class HLRStatItem
 *
 * Class of statistics by HLR requests
 *
 * @package Intis\SDK\Entity
 */
class HLRStatItem extends HLRResponse {

    /**
     * @var int|string Phone number
     */
    private $phone;
    /**
     * @var integer Message ID
     */
    private $messageId;
    /**
     * @var float Final price
     */
    private $totalPrice;
    /**
     * @var integer Request ID
     */
    private $requestId;
    /**
     * @var string Time of HLR request
     */
    private $requestTime;

    public function __construct($phone, $obj) {
        parent::__construct($obj);
        $this->phone = $phone;
        $this->messageId = $obj->message_id;
        $this->totalPrice = $obj->total_price;
        $this->requestId = $obj->request_id;
        $this->requestTime = $obj->request_time;
    }
    
    /**
     * Getting phone number
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
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
     * Getting final price of request
     *
     * @return float
     */
    public function getTotalPrice() {
        return $this->totalPrice;
    }

    /**
     * Getting request ID
     *
     * @return integer
     */
    public function getRequestId() {
        return $this->requestId;
    }

    /**
     * Getting time of request
     *
     * @return string
     */
    public function getRequestTime() {
        return $this->requestTime;
    }
}
