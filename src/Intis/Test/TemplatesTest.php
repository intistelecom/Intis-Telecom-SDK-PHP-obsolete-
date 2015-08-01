<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 21:52
 */


namespace Intis\Test;

require_once  __DIR__.'/../../../vendor/autoload.php';

use Intis\SDK\IntisClient;


class TemplatesTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getPhoneBaseItems(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);

        $templates = $client->getTemplates();

        foreach($templates as $template){
            $template->getId();
            $template->getTitle();
            $template->getTemplate();
            $template->getCreatedAt();
        }

        $this->assertInternalType('array',$templates);
        $first = $templates[0];
        $this->assertInstanceOf('Intis\SDK\Entity\Template',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\TemplateException
     */
    public function test_getPhoneBaseItemsException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);

        $client->getTemplates();
    }
}
