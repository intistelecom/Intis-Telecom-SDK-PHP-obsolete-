<?php
/*
 * Запрос списка отправителей
 */

require_once('autoloader.php');

use Intis\SDK\IntisClient;
use Intis\SDK\SDKException;

$login = 'rso';
$apiKey = 'cfe4fb6f670914b7897cc2783234b7428d6dc826';
$apiHost = 'http://dev.sms16.ru/get/';

$client = new IntisClient($login, $apiKey, $apiHost);

try{
    $originators = $client->getOriginators();

    foreach($originators as $originator){
        $originator->getOriginator();
        $originator->getState();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}

