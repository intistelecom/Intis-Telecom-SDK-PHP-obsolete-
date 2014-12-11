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
    $baseId = 125472;
    $page = 1;
    $items = $client->getPhoneBaseItems($baseId, $page);

    foreach($items as $item){
        $item->getPhone();
        $item->getFirstName();
        $item->getMiddleName();
        $item->getLastName();
        $item->getGender();
        $item->getNetwork();
        $item->getArea();
        $item->getNote1();
        $item->getNote2();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}