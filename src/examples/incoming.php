<?php
/**
 * Get incoming messages
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\IncomingMessage;
use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';
$date = new DateTime('now', new DateTimeZone('UTC'));

$client = new IntisClient($login, $apiKey, $host);

/** @var IncomingMessage[] $results */
$results = $client->getIncomingMessages($date->format('Y-m-d'));

echo sprintf('%-10s %-10s %-10s %-10s %-10s %-10s', 'Id', 'Received at', 'Originator', 'Prefix', 'Text', 'Destination') . PHP_EOL;
foreach ($results as $message) {
    echo sprintf(
        '%-10s %-10s %-10s %-10s %-10s %-10s',
        $message->getMessageId(),
        $message->getReceivedAt(),
        $message->getOriginator(),
        $message->getPrefix(),
        $message->getText(),
        $message->getDestination()
    ) . PHP_EOL;
}