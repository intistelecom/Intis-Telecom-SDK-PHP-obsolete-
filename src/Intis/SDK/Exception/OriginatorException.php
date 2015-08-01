<?php

namespace Intis\SDK\Exception;

class OriginatorException extends SDKException{
    public function __construct($code){
        parent::__construct(self::$messages[$code], $code);
    }
}