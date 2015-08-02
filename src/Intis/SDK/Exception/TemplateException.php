<?php

namespace Intis\SDK\Exception;

class TemplateException extends \Exception{
    public function __construct($code){
        parent::__construct(SDKException::$messages[$code], $code);
    }
}