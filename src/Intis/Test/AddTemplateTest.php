<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 22:51
 */

namespace Intis\Test;

require  '../../../vendor/autoload.php';

use Intis\SDK\IntisClient;

class AddTemplateTest extends \PHPUnit_Framework_TestCase {
    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_addTemplate(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $templteId = $client->addTemplate("testPHP3", "template for testPHP1");
        $this->assertNotEquals(0, $templteId);
    }

    /**
     * @expectedException Intis\SDK\Exception\AddTemplateException
     */
    public function test_addTemplateException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $client->addTemplate("testPHP1", "template for testPHP1");
    }
}
