<?php
/**
 * Statistics for the current month
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\DailyStats;
use Intis\SDK\Entity\Stats;
use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';

$date = new DateTime('now', new DateTimeZone('UTC'));

$client = new IntisClient($login, $apiKey, $host);

/** @var DailyStats[] $statistics */
$statistics = $client->getDailyStatsByMonth($date->format('Y'), $date->format('m'));

foreach ($statistics as $daily) {

    echo 'Day: ' . $daily->getDay() . PHP_EOL;

    /** @var Stats[] $stats */
    $stats = $daily->getStats();
    echo sprintf('%-10s %-25s %-10s %-10s', 'State', 'Cost', 'Currency', 'Count') . PHP_EOL;
    foreach ($stats as $stat) {
        echo sprintf('%-10s %-25s %-10s %-10s', $stat->getState(), $stat->getCost(), $stat->getCurrency(), $stat->getCount()) . PHP_EOL;
    }
    echo sprintf("%'-55s", '-') . PHP_EOL;
}