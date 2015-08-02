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
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_addTemplate(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $templteId = $client->addTemplate("testPHP3", "template for testPHP1");
        $this->assertNotEquals(0, $templteId);
    }

    /**
     * @expectedException Intis\SDK\Exception\AddTemplateException
     */
    public function test_addTemplateException(){
        $connector = new LocalApiConnector($this->getErrorData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->addTemplate("testPHP1", "template for testPHP1");
    }

    private function getData(){
        $result = '{"id":1}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
