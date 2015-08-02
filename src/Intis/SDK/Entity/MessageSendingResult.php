<?php
namespace Intis\SDK\Entity;

/**
 * Class MessageSendingResult
 * Class of getting response to SMS sending
 *
 * @package Intis\SDK\Entity
 */
class MessageSendingResult
{
    private $phone;

    private $isOk;

    /**
     * @return Phone number
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return Success result
     */
    public function isOk()
    {
        return $this->isOk;
    }

    /**
     * @param mPhone - Phone number
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mIsOk - Success result
     */
    public function setIsOk($isOk)
    {
        $this->isOk = $isOk;
    }
}
