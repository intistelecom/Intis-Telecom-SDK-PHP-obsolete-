<?php

namespace Intis\SDK\Exception;

class DailyStatsException extends SDKException{
    public function __construct($code){
        parent::__construct(self::$messages[$code], $code);
    }
}