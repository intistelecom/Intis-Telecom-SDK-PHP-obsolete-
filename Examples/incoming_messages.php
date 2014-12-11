<?php
/*
 * Запрос входящих СМС
 */

require_once('autoloader.php');

use Intis\SDK\IntisClient;
use Intis\SDK\SDKException;

$login = 'rso';
$apiKey = 'cfe4fb6f670914b7897cc2783234b7428d6dc826';
$apiHost = 'http://dev.sms16.ru/get/';

$client = new IntisClient($login, $apiKey, $apiHost);

try{
    $date = '2014-11-25';
    $result = $client->getIncomingMessages($date);

    foreach($result as $one){
        $one->getMessageId();
        $one->getOriginator();
        $one->getPrefix();
        $one->getReceivedAt();
        $one->getText();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}

