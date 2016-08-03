<?php
/**
 * Check phone
 * Block phone
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';
$phone = 'phone number';

$client = new IntisClient($login, $apiKey, $host);

if ($client->checkStopList($phone)->getId()) {
    echo sprintf('phone %s already blocked', $phone) . PHP_EOL;
    exit(1);
}

echo sprintf('phone %s blocked #%s', $phone, $client->addToStopList($phone)) . PHP_EOL;