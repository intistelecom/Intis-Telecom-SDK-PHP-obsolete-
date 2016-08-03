<?php

/**
 * Get senders
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\Originator;
use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';

$client = new IntisClient($login, $apiKey, $host);

/** @var Originator[] $results */
$results = $client->getOriginators();

echo sprintf('%-10s %-10s', 'State', 'Originator') . PHP_EOL;
foreach ($results as $sender) {
    echo sprintf('%-10s %-10s', $sender->getState(), $sender->getOriginator()) . PHP_EOL;
}

