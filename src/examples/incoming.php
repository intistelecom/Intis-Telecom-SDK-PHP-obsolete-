<?php
/**
 * Get incoming messages
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\IncomingMessage;
use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';
$date = new DateTime('now', new DateTimeZone('UTC'));

$client = new IntisClient($login, $apiKey, $host);

/** @var IncomingMessage[] $results */
$results = $client->getIncomingMessages($date->format('Y-m-d'));

echo sprintf('%-10s %-10s %-10s %-10s %-10s', 'Id', 'Received at', 'Originator', 'Prefix', 'Text') . PHP_EOL;
foreach ($results as $message) {
    echo sprintf(
        '%-10s %-10s %-10s %-10s %-10s',
        $message->getMessageId(),
        $message->getReceivedAt(),
        $message->getOriginator(),
        $message->getPrefix(),
        $message->getText()
    ) . PHP_EOL;
}