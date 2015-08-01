<?php

namespace Intis\SDK\Exception;

class PhoneBaseException extends SDKException{
    public function __construct($code){
        parent::__construct(self::$messages[$code], $code);
    }
}