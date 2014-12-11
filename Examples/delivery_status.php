<?php
/*
 * Запрос статусов
 */

require_once('autoloader.php');

use Intis\SDK\IntisClient;
use Intis\SDK\SDKException;

$login = 'rso';
$apiKey = 'cfe4fb6f670914b7897cc2783234b7428d6dc826';
$apiHost = 'http://dev.sms16.ru/get/';

$client = new IntisClient($login, $apiKey, $apiHost);

try{
    $messageId = array('4091297100348873330001','4091297100348880230003');
    /*
     * || $messageId = '4091297100348873330001,4091297100348880230003';
     */

    $deliveryStatus = $client->getDeliveryStatus($messageId);

    foreach($deliveryStatus as $message){
        $message->getMessageId();
        $message->getMessageStatus();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}