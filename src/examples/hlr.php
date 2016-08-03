<?php
/**
 * Hlr check phones
 * Hlr statistics for the current month
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\HLRResponse;
use Intis\SDK\Entity\HLRStatItem;
use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';
$phones = [
    '79033065950'
];

$client = new IntisClient($login, $apiKey, $host);

/** @var HLRResponse[] $results */
$results = $client->makeHLRRequest($phones);
echo sprintf(
        '%-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s',
        'Id',
        'Destination',
        'Status',
        'IMSI',
        'MCC',
        'MNC',
        'Original country',
        'Roaming country',
        'Ported country',
        'Price per message',
        'Ported',
        'Is roaming'
    ) . PHP_EOL;

foreach ($results as $item) {
        echo sprintf(
                '%-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s %-10s',
                $item->getId(),
                $item->getDestination(),
                $item->getStatus(),
                $item->getIMSI(),
                $item->getMCC(),
                $item->getMNC(),
                $item->getOriginalCountryName() . '-' . $item->getOriginalCountryCode() . ' ' . $item->getOriginalNetworkName() . '-' . $item->getOriginalNetworkPrefix(),
                $item->getRoamingCountryName() . '-' . $item->getRoamingCountryPrefix() . ' ' . $item->getRoamingNetworkName() . '-' . $item->getRoamingNetworkPrefix(),
                $item->getPortedCountryName() . '-' . $item->getPortedCountryPrefix() . ' ' . $item->getPortedNetworkName() . '-' . $item->getPortedNetworkPrefix(),
                $item->getPricePerMessage(),
                $item->isPorted() ? 'true' : 'false',
                $item->isInRoaming() ? 'true' : 'false'
            ) . PHP_EOL;
}

echo PHP_EOL;


$date = new DateTime('now', new DateTimeZone('UTC'));
$from = $date->format('Y-m-01');
$to = $date->format('Y-m-d');

/** @var HLRStatItem[] $results */
$results = $client->getHlrStats($from, $to);
echo sprintf('%-10s %-10s %-25s %-10s %-10s', 'Phone', 'Message id', 'Total price', 'Request id', 'Request time') . PHP_EOL;
foreach ($results as $item) {
    echo sprintf(
            '%-10s %-10s %-25s %-10s %-10s',
            $item->getPhone(),
            $item->getMessageId(),
            $item->getTotalPrice(),
            $item->getRequestId(),
            $item->getRequestTime()
        ) . PHP_EOL;
}