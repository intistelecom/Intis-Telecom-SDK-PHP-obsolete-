<?php
/**
 * Get operator by phone
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';
$phone = 'phone number';

$client = new IntisClient($login, $apiKey, $host);

$result = $client->getNetworkByPhone($phone);

echo sprintf("Phone: %s\nNetwork: %s", $phone, $result->getTitle()) . PHP_EOL;