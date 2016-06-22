<?php
/**
 * get phone bases
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\PhoneBase;
use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';

$client = new IntisClient($login, $apiKey, $host);

/** @var PhoneBase[] $results */
$results = $client->getPhoneBases();

echo sprintf('%-10s %-10s %-10s %-10s', 'Id', 'Title', 'Count', 'Pages') . PHP_EOL;
foreach ($results as $base) {
    echo sprintf(
        '%-10s %-10s %-10s %-10s',
        $base->getBaseId(),
        $base->getTitle(),
        $base->getCount(),
        $base->getPages()
    ) . PHP_EOL;
}