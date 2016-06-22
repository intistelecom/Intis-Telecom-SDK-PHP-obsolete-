<?php
/**
 * Get templates
 * Add template
 */

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Intis\SDK\Entity\Template;
use Intis\SDK\IntisClient;

$login = 'larissa44';
$apiKey = '9e561cdea0ff5870fa1b920e63c09c42abe7cf0d';
$host = 'https://go.intistele.com/external/get';
$phone = '33333333333';

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