<?php

namespace Intis\SDK\Exception;

class HLRResponseException extends \Exception{
    public function __construct($code){
        parent::__construct(SDKException::$messages[$code], $code);
    }
}