<?php
/*
 * Статистика HLR запросов
 */

require_once('autoloader.php');

use Intis\SDK\IntisClient;
use Intis\SDK\SDKException;

$login = 'rso';
$apiKey = 'cfe4fb6f670914b7897cc2783234b7428d6dc826';
$apiHost = 'http://dev.sms16.ru/get/';

$client = new IntisClient($login, $apiKey, $apiHost);

try{
    $from = '2014-07-01';
    $to = '2014-10-01';
    $result = $client->getHlrStats($from, $to);

    foreach($result as $hlr){
        $hlr->getId();
        $hlr->getPhone();
        $hlr->getMessageId();
        $hlr->getTotalPrice();
        $hlr->getDestination();
        $hlr->getIMSI();
        $hlr->getMCC();
        $hlr->getMNC();
        $hlr->getOriginalCountryCode();
        $hlr->getOriginalCountryName();
        $hlr->getOriginalNetworkName();
        $hlr->getOriginalNetworkPrefix();
        $hlr->getPortedCountryName();
        $hlr->getPortedCountryPrefix();
        $hlr->getPortedNetworkName();
        $hlr->getPortedNetworkPrefix();
        $hlr->getRoamingCountryName();
        $hlr->getRoamingCountryPrefix();
        $hlr->getRoamingNetworkName();
        $hlr->getRoamingNetworkPrefix();
        $hlr->getStatus();
        $hlr->getPricePerMessage();
        $hlr->isInRoaming();
        $hlr->isPorted();
        $hlr->getRequestId();
        $hlr->getRequestTime();
    }
}
catch (SDKException $e){
    $errorMessage = $e->getMessage();
    $code = $e->getCode();
}
