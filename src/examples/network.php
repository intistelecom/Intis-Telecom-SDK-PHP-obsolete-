<?php
/**
 * Get operator by phone
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';
$phone = '34675472924';

$client = new IntisClient($login, $apiKey, $host);

/** TODO отдает ошибку 0 и ответ */
$result = $client->getNetworkByPhone($phone);

sprintf("Phone: %s\nNetwork: %s", $phone, $result->getTitle()) . PHP_EOL;