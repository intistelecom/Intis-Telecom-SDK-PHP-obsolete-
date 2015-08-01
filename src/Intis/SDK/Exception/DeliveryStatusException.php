<?php

namespace Intis\SDK\Exception;

class DeliveryStatusException extends SDKException{
    public function __construct($code){
        parent::__construct(self::$messages[$code], $code);
    }
}