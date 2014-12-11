<?php

namespace Intis\SDK\Entity;

/**
 * Class Balance
 *
 * Class of getting balance
 *
 * @package Intis\SDK\Entity
 */
class Balance{
    /**
     * @var float amount of money
     */
    private $amount;
    /**
     * @var string name of currency
     */
    private $currency;
    
    function __construct($obj) {
        $this->amount = $obj->money;
        $this->currency = $obj->currency;
    }

    /**
     * Getting amount of money
     *
     * @return float
     */
    public function getAmount(){
        return $this->amount;
    }
    
    /**
     * Getting name of currency 
     *
     * @return string
     */
    public function getCurrency(){
        return $this->currency;
    }
}

