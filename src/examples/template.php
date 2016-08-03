<?php
/**
 * Get templates
 * Add template
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\Template;
use Intis\SDK\IntisClient;

$login = 'your login';
$apiKey = 'your key';
$host = 'https://go.intistele.com/external/get';
$phone = 'phone number';

$client = new IntisClient($login, $apiKey, $host);

/** @var Template[] $templates */
$templates = $client->getTemplates();

foreach ($templates as $template) {
    echo sprintf(
            "Id: %s\nTitle: %s\nTemplate: %s\n", 
            $template->getId(), 
            $template->getTitle(), 
            $template->getTemplate()
        ) . PHP_EOL;
}

$id = $client->addTemplate('Test', 'Test');
echo sprintf("Add template: #%s", $id) . PHP_EOL;

$remove = $client->removeTemplate('Test');
echo sprintf("Remove template Test result: %s", $remove->getResult()) . PHP_EOL;