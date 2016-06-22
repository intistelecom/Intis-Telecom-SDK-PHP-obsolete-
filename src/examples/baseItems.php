<?php

/**
 * Get senders
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\PhoneBase;
use Intis\SDK\Entity\PhoneBaseItem;
use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';

$client = new IntisClient($login, $apiKey, $host);

/** @var PhoneBase[] $results */
$bases = $client->getPhoneBases();
if (!count($bases)) {
    echo 'Bases empty' . PHP_EOL;
    exit(1);
}
$base = $bases[0];

/** @var PhoneBaseItem[] $results */
$results = $client->getPhoneBaseItems($base->getBaseId());

echo sprintf('Base: %s, page 1', $base->getTitle())  . PHP_EOL;;
echo sprintf('%-15s %-25s %-15s %-10s', 'Phone', 'Name', 'Birthday', 'Gender') . PHP_EOL;
foreach ($results as $item) {
    echo sprintf(
            '%-15s %-25s %-15s %-10s',
            $item->getPhone(),
            implode(' ', array($item->getLastName(), $item->getFirstName(), $item->getMiddleName())),
            $item->getBirthDay(),
            $item->getGender()
        ) . PHP_EOL;
}