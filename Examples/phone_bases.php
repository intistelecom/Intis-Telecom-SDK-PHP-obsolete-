<?php
/*
 * Запрос списка баз
 */

require_once('autoloader.php');

use Intis\SDK\IntisClient;
use Intis\SDK\SDKException;

$login = 'rso';
$apiKey = 'cfe4fb6f670914b7897cc2783234b7428d6dc826';
$apiHost = 'http://dev.sms16.ru/get/';

$client = new IntisClient($login, $apiKey, $apiHost);

try{
    $phoneBases = $client->getPhoneBases();

    foreach($phoneBases as $oneBase){
        $oneBase->getBaseId();
        $oneBase->getTitle();
        $oneBase->getCount();
        $oneBase->getPages();
        
        $birthday = $oneBase->getBirthdayGreetingSettings();
        $birthday->getEnabled();
        $birthday->getDaysBefore();
        $birthday->getOriginator();
        $birthday->getTimeToSend();
        $birthday->getUseLocalTime();
        $birthday->getTemplate();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}
