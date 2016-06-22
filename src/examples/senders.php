<?php

/**
 * Get senders
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\Originator;
use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';

$client = new IntisClient($login, $apiKey, $host);

/** @var Originator[] $results */
$results = $client->getOriginators();

echo sprintf('%-10s %-10s', 'State', 'Originator') . PHP_EOL;
foreach ($results as $sender) {
    echo sprintf('%-10s %-10s', $sender->getState(), $sender->getOriginator()) . PHP_EOL;
}

