<?php
/**
 * Check phone
 * Block phone
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';
$phone = '33333333333';

$client = new IntisClient($login, $apiKey, $host);

/** TODO возвращает ошибку Empty results на любой номер */
if ($client->checkStopList($phone)) {
    echo sprintf('phone %s already blocked', $phone) . PHP_EOL;
    exit(1);
}

echo sprintf('phone %s blocked #%s', $phone, $client->addToStopList($phone)) . PHP_EOL;